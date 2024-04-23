@extends('layouts.admin-layout.app')

@section('content')
<div class="content-wrapper">
   
    <div class="card">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body">
            <h3>Nav Bar</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Elements</th>
                    <th scope="col">Position</th>
                    <th scope="col">Route</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($navbarItems as $index => $item)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->position }}</td>
                        <td>{{ $item->route }}</td>
                        <td>
                            
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- Dropdown Trigger Content -->
                                    <b>...</b>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Dropdown Items -->
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editModal{{ $index }}">Edit</button>
                                    <form action="{{ route('delete.manu',['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="filename" value="{{ $item['route'] }}">
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                   
                                </div>
                            </div>                                
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $index }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $index }}Label">Edit Nav Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('navitems.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editName{{ $index }}">Name:</label>
                                            <input type="text" class="form-control" id="editName{{ $index }}" name="name" value="{{ $item->name }}" required>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="editRoute{{ $index }}">Route:</label>
                                            <input type="text" class="form-control" id="editRoute{{ $index }}" name="route" value="{{ $item->route }}" required>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="editPosition{{ $index }}">Position:</label>
                                            <input type="number" class="form-control" id="editPosition{{ $index }}" name="position" value="{{ $item->position }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
{{--     
<hr>
<div class="card">
    <div class="card-body">

        <form id="navigation-form" action="/update-navigation-order" method="POST">
            @csrf <!-- CSRF token for Laravel -->
            <div class="container">
                <h2>Navigation</h2>
                <table id="sortable-table" class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Route</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($navbarItems as $index => $item)
                        <tr draggable="true">
                            <td class="position">{{ $item->id }}</td>
                            <td><span class="drag-handle">&#9776;</span> {{ $item->name }}</td>
                            <td>{{ $item->route }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="updatedvalue" name="updated_data[]" value="" />
            <button type="submit" id="save-order-btn" class="btn btn-primary">Save Order</button>
        </form>

    </div>
</div> --}}


{{-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
const tbody = document.querySelector("#sortable-table tbody");

tbody.addEventListener("dragstart", function(event) {
    event.dataTransfer.setData("text/plain", event.target.closest("tr").outerHTML);
    event.target.closest("tr").classList.add("dragging");
});

tbody.addEventListener("dragover", function(event) {
    event.preventDefault();
    const draggingElement = document.querySelector(".dragging");
    const closestTr = event.target.closest("tr");
    if (closestTr && closestTr !== draggingElement) {
        tbody.insertBefore(draggingElement, closestTr.nextSibling);
        updateIndexesAndLogData();
    }
});

tbody.addEventListener("dragenter", function(event) {
    event.preventDefault();
    const draggingElement = document.querySelector(".dragging");
    const closestTr = event.target.closest("tr");
    if (closestTr && closestTr !== draggingElement) {
        tbody.insertBefore(draggingElement, closestTr);
        updateIndexesAndLogData();
    }
});

tbody.addEventListener("dragend", function(event) {
    document.querySelector(".dragging").classList.remove("dragging");
    updateIndexesAndLogData(); // Update indexes after dragging ends and log data
});

function updateIndexesAndLogData() {
    const rows = tbody.querySelectorAll("tr");
    // const reorderedData = [];
    rows.forEach((row, index) => {
        row.querySelector(".position").textContent = index + 1;
        const name = row.querySelector("td:nth-child(2)").textContent.trim();
        const route = row.querySelector("td:nth-child(3)").textContent.trim();
        const position = index + 1;
        const rowData = {
            name,
            route,
            position
        };
        reorderedData.push(rowData);
    });




    $(document).ready(function(){
    // Set the value to the input field with id "myInput"
    $("#updatedvalue").val(reorderedData);
});
}

</script>

    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


 --}}



@stop
