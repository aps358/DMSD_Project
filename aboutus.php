<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>About Us</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

</head>
<body>
<div id="primary_container">

    <!--There is where the navigation will go-->
    <div id="navigation">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">CS-631 BANK</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!--There is where the body content will go-->
    <div id="aboutus-content">
        <div class="container">
            <div class="row">
                <p class="h1 text-center">
                    About Us
                </p><br/>
                <div class="text-center col-md-6 col-sm-6 col-xs-12">
                    <img alt="njit" class="img-responsive center-block" src="images/njit.png"/>
                    <br/>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="text-justify lead">
                        We are Graduate students of NJIT have prepared this web application as a project for the subject of
                        CS-631 Data Management System Design under the guidance of professor Vincent Oria. This web application has
                        been made using HTML, CSS, JavaScript, PHP & MySQL.
                    </p>
                </div>
            </div>

            <!-- Form Content -->
            <div class="row">
                <div class="col-md-3 col-sm-3"></div>
                <div class="text-center offset-md-6 col-md-6 col-sm-6 col-xs-12">
                    <!--There is where the body content will go-->

                    <div class="green-contact-form bg-white">


                        <div class="form-box">
                            <h3>Send Us a Message</h3>

                            <form action="javascript:alert('Thank you for contacting us.\nWe will get back to you soon !');"
                                  method="post"
                                  onsubmit="window.location.reload()">
                                <fieldset class="form-group">
                                    <label for="yourName">Your Name (required)</label>
                                    <input class="form-control" id="yourName" placeholder="Enter Your Name" required
                                           type="text">
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="yourEmail">Email Adressess (required)</label>
                                    <input class="form-control" id="yourEmail" placeholder="Enter Your Email"
                                           required type="email">
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="yourPhone">Telephone number</label>
                                    <input class="form-control" id="yourPhone" placeholder="Enter Your Phone"
                                           type="text">
                                </fieldset>

                                <fieldset class="form-group">
                                    <label for="yourEmail">Your message (required)</label>
                                    <textarea class="form-control" rows="6"></textarea>
                                </fieldset>
                                <button class="btn btn-dark" type="submit">SEND MESSAGE</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <!--There is where the footer will go-->
    <div id="footer">
        <footer class="sticky-footer bg-primary container-fluid mt-auto">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="text-lead">&copy; Amey Sawant & Tejas Kenjale</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>
<script src="js/myjavascript.js"></script>
</body>
</html>