<!DOCTYPE >
<html lang='en' >
   <head>
      <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
      <title>
        Demo Trial Examination
      </title>

      <link href='{{ asset("user/mock_user_assets/exam_assets/assets/css/screen.css")}}'  rel='stylesheet' type='text/css' />
      <!-- Include jQuery and SweetAlert libraries -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" crossorigin="anonymous">


    <script>

        // Document ready function
    $(document).ready(function () {

        // Clear stored data
        localStorage.removeItem('timer');
        localStorage.removeItem('currentQuestionIndex');
        localStorage.removeItem('questionData');
        localStorage.removeItem('startTimeForNextQuestion');

    });


    </script>


   </head>
   <body>
      <div id='root'>
         <div id='titlebar'>
            <div class='container2'>
               <div id='header'>
                  <h1>
                    <a href='#'>Demo Trial Examination</a>
                  </h1>

               </div>
            </div>
         </div>
         <div id='flag'>
         </div>
         <div class='container2' id='main'>
            <div id='messages'></div>
            <div class='left'>
               <h4>Welcome to the MCQ Trial Examination</h4>
               <p>Copyright of all examination materials rests with the Australian Medical Council &copy;. No part of any examination may be reproduced, stored or transmitted by any means.</p>
               <p>Any attempt to reproduce examination materials will be considered a breach of examination procedures and constitutes a breach of Australian Copyright Law. The AMC Board of Examiners will investigate any such breaches and the AMC may take action against individual candidates that may include, but not be limited to:</p>
               <ul>
                  <li>Withholding or cancellation of the results of the candidate involved.</li>
                  <li>Suspension of candidature for a period to be determined.</li>
                  <li>Termination of eligibility to sit future AMC examinations for the purposes of registration.</li>
                  <li>Reporting of breaches of examination rules to all States and Territory Medical Boards.</li>
                  <li>Legal action to recover cost of examination material involved.</li>
               </ul>
               <p>I agree that in consideration of the AMC disclosing the examination to me, I shall (i) use the examination solely for the purpose of completing this examination and (ii) not disseminate or reveal to others the examination content. I have read, understood and agree with the above confidentiality statement.</p>
               <p>In order to proceed to your MCQ   Trial Examination, you MUST accept the terms of this Non-Disclosure Agreement. To do this, select “I AGREE” below.</p>

               <form action='#'>
                <fieldset>
                    <legend>
                        By proceeding to the next step you have agreed to these
                        <a href='#terms' rel='facebox' title='terms and conditions'>terms and conditions</a>
                    </legend>
                    <ol>
                        <li>
                            <label for='y'>
                                <input checked='checked' id='y' name='accept_copyright' type='radio' value='Y' />
                                <span>Y. I Agree</span>

                            </label>
                        </li>
                        <li>
                            <label for='n'>
                                <input id='n' name='accept_copyright' type='radio' value='N' />
                                <span>N. I Do Not Agree</span>

                            </label>
                        </li>
                        <li class='button'>
                            <!-- Use a button instead of a link for better handling -->
                            <input id='next_button' type='button' value='Next Step' />
                        </li>
                    </ol>
                </fieldset>
            </form>
            </div>
            <div id='terms' style='display:none;'>
               <h3>Copyright notice</h3>
               <p>Copyright of all examination materials rests with the Australian Medical Council&copy;. No part of any examination may be reproduced, stored or transmitted by any means.</p>
               <p>Any attempt to reproduce examination materials will be considered a breach of examination procedures and constitutes a breach of Australian copyright law. The AMC Board of Examiners will investigate any such breaches and the AMC may take action against individual candidates that may include, but not be limited to:</p>
               <ul>
                  <li>Withholding or cancellation of the results of the candidate involved</li>
                  <li>Suspension of candidature for a period to be determined</li>
                  <li>Termination of eligibility to sit future AMC examination for the purpose of registration</li>
                  <li>Reporting of breaches of examination rules to all Sate and Territory Medical Boards</li>
                  <li>Legal action to recover the cost of the examination material involved.</li>
               </ul>
               <p>I agree that in consideration of the AMC disclosing the examination to me, I shall (i) use the examination solely for the purpose of completing this examination and (ii) not disseminate or reveal to others the examination content. I have read, understood and agree with the above confidentiality statement.</p>
            </div>


            <div id='bottom_of_page'>
               &nbsp;
            </div>
            <div id='root-footer'></div>
         </div>
      </div>
      <div id='footer'>
         <div id='copyright'>
         </div>

         <div id='site-actions'>
         </div>
      </div>

   </body>


   <script>
    $(document).ready(function () {
        // Add click event listener to the "Next Step" button
        $('#next_button').click(function () {
            // Check if the "Yes" radio button is selected
            if ($('#y').prop('checked')) {
                // Redirect to another page
                window.location.href = "{{ url('/mocks_demo_start_exam') }}";
            } else {
                // Show SweetAlert for confirmation
                Swal.fire({
                    title: 'Error',
                    text: 'Please accept to our non-disclosure agreement.',
                    icon: 'warning',

                });
            }
        });
    });
</script>
</html>
