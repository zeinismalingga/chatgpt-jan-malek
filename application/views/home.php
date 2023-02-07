<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OpenAI GPT3 Text Completion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <h1 class="text-center mt-5">OpenAI GPT-3 Text Completion</h1>

            <div class="card">
                <div class="card-body">
                    <form class="row g-3 justify-content-md-center">
                        <div class="col-md-8">
                            <input type="text" id="text" class="form-control" placeholder="" autocomplete="off" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" id="submit" class="btn btn-primary mb-3">Submit</button>
                        </div>
                    </form>

                    <div class="loader mx-auto" style="display: none"></div>

                    <!-- Result  -->
                    <div class="row justify-content-md-center">
                        <div class="col-md-8">
                            <span id="results" class="text-start" style="white-space: pre-line"></span>
                        </div>
                        <div class="col-md-1">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center fw-bold">

                </div>
            </div>

        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
        $("#submit").click(function(event) {
            $('#results').html('')
            event.preventDefault()
            const text = $('#text').val()

            $.ajax({
                url: "<?php echo base_url('index.php/home/get_response') ?>",
                type: 'POST',
                data: {
                    text
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    console.log(response)
                    response = JSON.parse(response)
                    var result = response.choices.at(0).text.trim()
                    $('#results').html(result)
                },
                complete: function() {
                    $('.loader').hide();
                }
            });
        });
    </script>
</body>

</html>