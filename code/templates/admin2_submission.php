<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Faculty Websites - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/templates/admin2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="assets/templates/admin2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/templates/admin2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/templates/admin2/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Submit a File Manually:</h3>
                    </div>
                    <div class="panel-body">
                    	<?php
							$segment = $this->session->getSegment('app');
		                ?>
		                <?php if (!empty($segment->getFlash('message'))) : ?>
							<?php if (!empty($segment->getFlash('message-status'))) : ?>
								<div class="alert alert-message-login alert-<?= $segment->getFlash('message-status'); ?> alert-dismissable">
							<?php else : ?>
								<div class="alert alert-message-login alert-warning alert-dismissable">
							<?php endif; ?>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                <?php echo $segment->getFlash('message'); ?>
				            </div>
		                <?php endif; ?>
                        <form role="form" method="POST" action="api/1.0/submission" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" required="required" placeholder="Organization" name="organization" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required="required" placeholder="API Key" name="api_key" type="password" value="">
                                </div>
								<div class="form-group">
                                    <input class="form-control" name="submission_file" type="file">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/templates/admin2/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/templates/admin2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/templates/admin2/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/templates/admin2/dist/js/sb-admin-2.js"></script>

</body>

</html>

