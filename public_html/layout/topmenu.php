<?php
if(session_status()== PHP_SESSION_NONE)
{
    session_start();
}

if (!$_SESSION['id'])
{
    header('Location: ./../views/signin.php');
}
?>
<div class="topbar" style="background-color: #f5f5f5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="topbar-left text-left">
                    <ul class="list-inline">
                        <li><a class="btn-group" href="mailto:mohamed.abdelhafidh@esprit.tn"><i class="fa fa-envelope-o"> </i> mohamed.abdelhafidh@esprit.tn </a></li>
                        <li><a class="btn-group" href="tel:+216 58611994"><i class="fa fa-phone"></i>Tel: +216 58611994 </a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="topbar-right text-right">


                    <ul class="list-inline text-uppercase top-menu"style="padding-right: 30px;">
                        <li><a href="../../action.php?red=home" class="btn" style="padding-right: 20px;">Home</a></li>
                        <li><a href="../../action.php?red=cart" class="btn" style="padding-right: 20px;">My cart</a></li>
                        <li><a class="btn" href="../../action.php?logout=true">Logout</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>