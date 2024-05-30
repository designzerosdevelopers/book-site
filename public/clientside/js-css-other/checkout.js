
			// Attach event listeners to input fields for validation
			document.getElementById('card_number').addEventListener('input', validateCardNumber);
			document.getElementById('expiretion_date').addEventListener('input', validateExpireDate);
			document.getElementById('cvv').addEventListener('input', validateCVV);
	
	    // Function to validate card number input
		function validateCardNumber() {
			var cardNumberInput = document.getElementById('card_number');
			cardNumberInput.value = cardNumberInput.value.replace(/\D/g, ''); // Remove non-numeric characters
			if (cardNumberInput.value.length > 14) {
				cardNumberInput.value = cardNumberInput.value.slice(0, 14); // Truncate to 14 digits
			}
		}
	
        // Function to validate expire date input
        function validateExpireDate() {
            var expireDateInput = document.getElementById('expiretion_date');
            var sanitizedValue = expireDateInput.value.replace(/\D/g, ''); // Remove non-numeric characters
            var formattedValue = '';

            if (sanitizedValue.length > 4) {
                sanitizedValue = sanitizedValue.slice(0, 4); // Truncate to 4 digits
            }

            if (sanitizedValue.length >= 2) {
                formattedValue = sanitizedValue.slice(0, 2) + '/' + sanitizedValue.slice(2); // Insert '/'
            } else {
                formattedValue = sanitizedValue;
            }

            // Check if the last character removed was a slash
            if (expireDateInput.value.length > 0 && expireDateInput.value.slice(-1) === '/') {
                formattedValue = formattedValue.slice(0, -1); // Remove the slash
            }

            expireDateInput.value = formattedValue;
        }


	
		// Function to validate CVV input
		function validateCVV() {
			var cvvInput = document.getElementById('cvv');
			cvvInput.value = cvvInput.value.replace(/\D/g, ''); // Remove non-numeric characters
			if (cvvInput.value.length > 3) {
				cvvInput.value = cvvInput.value.slice(0, 3); // Truncate to 3 digits
			}
		}