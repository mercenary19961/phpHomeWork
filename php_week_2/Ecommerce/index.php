<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Example</title>
</head>
<body>
    <h1>API Example</h1>
    <button id="getButton">Send GET Request</button>
    <button id="postButton">Send POST Request</button>
    <div id="response"></div>

    <script>
        document.getElementById('getButton').addEventListener('click', () => {
            fetch('api.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').innerHTML = JSON.stringify(data);
                })
                .catch(error => console.error('Error:', error));
        });

        document.getElementById('postButton').addEventListener('click', () => {
            fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: 'John', age: 30 })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').innerHTML = JSON.stringify(data);
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
