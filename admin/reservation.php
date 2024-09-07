<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>TABLE RESERVATION</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/custom-styles.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li>
                            <a  href="../index.php"><i class="fa fa-home"></i>Homepage</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="page-header">TABLE RESERVATION</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">PERSONAL INFORMATION</div>
                                <div class="panel-body">
                                    <form action="" name="form" method="post">
                                        <div class="form-group">
                                            <label>Title*</label>
                                            <select name="title" class="form-control" required >
                                                <option value selected ></option>
                                                <option value="Miss.">Miss.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality*</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="nation"  value="Indian" checked="">Indian
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="nation"  value="Foreigner">Foreigner 
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Country*</label>
                                            <select name="country" class="form-control" required >
                                                <option value selected ></option>
                                                <option value="Australia">Australia</option>
                                                <option value="California">California</option>
                                                <option value="Bengluru">Bengluru</option>
                                                <option value="New Delhi">New Delhi</option>
                                                <option value="Mumbai">Mumbai</option>
                                                <option value="Cape Town">Cape Town</option>
                                                <option value="San Francisco">San Francisco</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Miami">Miami</option>
                                                <option value="Rio">Rio</option>
                                                <option value="Berlin">Berlin</option>
                                                <option value="France">France</option>
                                                <option value="New York">New York</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input name="phone" type ="text" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">RESERVATION INFORMATION</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Type Of Table</label>
                                            <select name="table"  class="form-control" required>
                                                <option value selected ></option>
                                                <option value="Table for 2">Table for 2</option>
                                                <option value="Table for 3">Table for 3</option>
                                                <option value="4">Table for 4</option>
                                                <option value="Table for 5">Table for 5</option>
                                                <option value="Table for 6">Table for 6</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <select name="purpose" class="form-control" required>
                                                <option value selected ></option>
                                                <option value="Meeting">Meeting</option>
                                                <option value="Casual">Casual</option>
                                                <option value="Celebration">Celebration</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Meal Plan</label>
                                            <select name="meal" class="form-control"required>
                                                <option value selected ></option>
                                                <option value="Breakfast">Breakfast</option>
                                                <option value="Lunch">Lunch</option>
                                                <option value="Dinner">Dinner</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input name="tme" type ="time" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input name="dte" type ="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="well">
                                    <h4><b>Verify you are not a bot</b></h4>
                                    <p>Enter the following code 
                                        <?php
                                        $Random_code = rand();
                                        echo $Random_code;
                                        ?> </p><br />
                                    <p>Enter the random code<br /></p>
                                    <input  type="text" name="cde"/>
                                    <input type="hidden" name="cd" value="<?php echo $Random_code; ?>" />
                                    <input type="submit" name="submit" class="btn btn-primary" value="Reserve">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 


if(isset($_POST["submit"]))
{
  
}
?>
