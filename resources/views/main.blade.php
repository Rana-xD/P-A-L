<!DOCTYPE html>
<html ng-app>
<head>
    <title>ログイン</title>
    <meta charset='utf-8' />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/custom/css/custom.css" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/custom/js/core.js" ></script>

    <!--[if lt IE 9]>
    <script src="/custom/js/html5shiv.js" type="text/javascript"></script>
    <script src="/custom/js/respond.js" type="text/javascript"></script>
    <![endif]-->

    <!-- backward reload script start -->
    <input type="hidden" id="refreshed" value="no">
    <script type="text/javascript">
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload()
            }
        };
    </script>

</head>
<body>
<div class="container">
    <div class="row" style="padding-top:120px;">
        <div class="col-xs-12 text-center"  style="padding:15px 0;">
            <img  style="display: inline-block;" class="img-responsive" src="http://www.pal-style.co.jp/img/hdr-logo.png">
        </div>
    </div>
    <div class="row">

        <div class="col-xs-12">
            <div class="login-header">
                <h3>ログイン</h3>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="form-wrapper">

                <div class="row">

                    <div class="col-xs-12">

                        <form name="loginForm" class="form-horizontal" role="form" action="login" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <!-- <label class="control-label col-xs-2" for="id">ID</label> -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-danger fade in" id="error">

                                          <p id="Error"></p>
                                         </div>
                                        <input placeholder="Email ID" class="form-control no-radius" id="id" type="text" name="name" value="{{ old('name') }}">
                                        <!-- <div ng-show="loginForm.name.$touched && loginForm.name.$invalid && loginForm.name.$error.required"><small style="color: red; display: block; text-align: center;">Please enter a valid user</small></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label class="control-label col-xs-2" for="password">Password</label> -->
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input placeholder="Password" class="form-control no-radius" id="password" type="password" name="password" value="{{ old('password') }}">
                                        <!-- <div ng-show="loginForm.password.$touched && loginForm.password.$invalid && loginForm.password.$error.required"><small style="color: red; display: block; text-align: center;">Please enter a valid password</small></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 text-center" style="margin-bottom:15px;">
                                        <input  class="btn custom-btn-primary login-btn form-control sm-radius" style="width: 50%;text-align:center;margin:0 auto;" type="submit" value="ログイン">
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                </div>

            </div>

        </div>
    </div>
</body>
</html>
