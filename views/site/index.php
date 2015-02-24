<?php
/* @var $this yii\web\View */
$this->title = 'Ice9 Interactive';
?>
<div class="site-index">

    <?php
    if(!Yii::$app->user->isGuest) {
        ?>

        <div class="container" style="margin-left: 6%;">


            <a href="template/index">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link">Template</div>
                </div>
            </a>
            <!--<a href="template/choose-template">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"> Create Quotation</div>
                </div>
            </a>-->
            <a href="quotation">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link">Quotation</div>
                </div>
            </a>

            <a href="company/index">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link">Company</div>
                </div>
            </a>
            <a href="clients">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link">Clients</div>
                </div>
            </a>
            <!-- <a href="user/admin/create"><div class="col-sm-3 home_item text-center text-info"> <div class="home_link">Create User </div> </div></a>-->
            <a href="#">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link">Create User</div>
                </div>
            </a>
            <a href="user/account">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"> User Profile</div>
                </div>
            </a>

        </div>

    <?php
    }else{
    ?>
    <div class="container-fluid">
        <iframe src="http://ice9apps.net/" frameborder="0" width="100%" height="600px"></iframe>
    </div>
    <?php
    }
    ?>

</div>
