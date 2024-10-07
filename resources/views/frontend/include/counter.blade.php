<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fade Out Effect Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            background-color: #f0f8ff; /* Light background color */
            padding: 50px 0; /* Space above and below */
        }
        .fade-item {
            background: rgba(255, 255, 255, 0.8); /* White with transparency */
            padding: 20px;
            border-radius: 8px;
            transition: opacity 0.5s ease; /* Smooth fade effect */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow */
        }
        .fade-out {
            opacity: 0.5; /* Fade out effect */
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="container">
        <div class="row gap-3">
            <div class="col-md-4 fade-item">
                <p>People</p>
                <p>2355</p>
            </div>
            <div class="col-md-4 fade-item">
                <p>People</p>
                <p>2355</p>
            </div>
            <div class="col-md-4 fade-item">
                <p>People</p>
                <p>2355</p>
            </div>
            <div class="col-md-4 fade-item">
                <p>People</p>
                <p>2355</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Select all fade items
    const fadeItems = document.querySelectorAll('.fade-item');

    // Function to handle scroll behavior
    function handleScroll() {
        fadeItems.forEach((item) => {
            const rect = item.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Check if the item is in view
            if (rect.top < windowHeight && rect.bottom > 0) {
                item.classList.remove('fade-out');
            } else {
                item.classList.add('fade-out');
            }
        });
    }

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll);

    // Initial check to set the fade state
    handleScroll();
</script>

</body>
</html>
