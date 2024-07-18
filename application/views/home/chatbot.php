<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Chatbot</h2>

<form id="chat-form">
    <label for="question">Ask a question:</label>
    <input type="text" id="question" name="question">
    <input type="submit" value="Submit">
</form>

<div id="response">
    <p>Response: <span id="answer"></span></p>
</div>

<script>
    $(document).ready(function(){
        $('#chat-form').on('submit', function(event){
            event.preventDefault();
            var question = $('#question').val();
            
            $.ajax({
                url: "<?php echo site_url('chatbot/get_response'); ?>",
                method: "POST",
                data: {question: question},
                dataType: "json",
                success: function(data){
                    $('#answer').text(data.answer);
                }
            });
        });
    });
</script>

</body>
</html>
