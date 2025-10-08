// Form validation for payment
document.addEventListener('DOMContentLoaded', function() {
    
    // Payment form validation
    var paymentForm = document.getElementById('paymentForm');
    
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            var cardNumber = document.getElementById('card_number').value;
            var cvv = document.getElementById('cvv').value;
            var expiry = document.getElementById('expiry').value;
            
            // Validate card number (should be 16 digits)
            if (cardNumber.length != 16 || isNaN(cardNumber)) {
                alert('Please enter a valid 16-digit card number');
                e.preventDefault();
                return false;
            }
            
            // Validate CVV (should be 3 digits)
            if (cvv.length != 3 || isNaN(cvv)) {
                alert('Please enter a valid 3-digit CVV');
                e.preventDefault();
                return false;
            }
            
            // Validate expiry format (MM/YY)
            var expiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
            if (!expiryPattern.test(expiry)) {
                alert('Please enter expiry date in MM/YY format');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
        
        // Auto-format card number
        var cardNumberInput = document.getElementById('card_number');
        if (cardNumberInput) {
            cardNumberInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '');
            });
        }
        
        // Auto-format CVV
        var cvvInput = document.getElementById('cvv');
        if (cvvInput) {
            cvvInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '');
            });
        }
        
        // Auto-format expiry date
        var expiryInput = document.getElementById('expiry');
        if (expiryInput) {
            expiryInput.addEventListener('input', function(e) {
                var value = this.value.replace(/\D/g, '');
                
                if (value.length >= 2) {
                    this.value = value.substring(0, 2) + '/' + value.substring(2, 4);
                } else {
                    this.value = value;
                }
            });
        }
    }
});
