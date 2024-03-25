<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
    <form method="post" action="{{route('paypalcharge')}}">
      @csrf
      <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="currency">Currency</label>
        <select name="currency" id="currency" class="form-control" required>
          <option value="USD">USD</option>
          <option value="EUR">EUR</option>
          <option value="GBP">GBP</option>
          <option value="CAD">CAD</option>
        </select>
      </div>
      <input type="submit" value="Pay" class="btn btn-info mt-3">
    </form>
  </div>
</body>
</html>