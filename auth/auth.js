// $(document).ready(function() {

//     $('#auth').submit(function(e) {
//         e.preventDefault(); // Prevent the default form submission
    
//         var formData = $(this).serialize(); // Serialize form data
//         formData += '&submit=submit'; // Append submit button value
    
//         $.ajax({
//             url: 'auth.php',
//             type: 'POST',
//             data: formData,
//             dataType: 'json',
//             success: function(response) {
//                 console.log("AJAX request successful. Response:", response);
//                 if (response.status === 'error') {
//                     $('#errors').html(''); // Clear previous errors
//                     var errorList = '<ul>';
//                     $.each(response.errors, function(index, error) {
//                         errorList += '<li>' + error + '</li>'; // List each error
//                     });
//                     errorList += '</ul>';
//                     $('#errors').html(errorList);
//                 } else {
//                     // Redirect to index.php on success
//                     window.location.href = 'home.php';
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.log("AJAX request failed. Status:", status, "Error:", error, "XHR:", xhr);
//                 $('#errors').html('<p>An error occurred: ' + error + '</p>');
//             }
//         });
//     });
//     });
    
    