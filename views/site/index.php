<?php
/* @var $this yii\web\View */
$this->title = 'Ice9 Interactive';
?>
<div class="site-index">

    <?php
    if(!Yii::$app->user->isGuest) {
        ?>

        <div class="container" style="margin-left: 6%;">


            <a href="template-fields/create-template">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"> Create Template</div>
                </div>
            </a>
            <a href="template/choose-template">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"> Create Quotation</div>
                </div>
            </a>
            <a href="quotation">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"> View/Edit Quotation</div>
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
            <a href="">
                <div class="col-sm-3 home_item text-center text-info">
                    <div class="home_link"></div>
                </div>
            </a>


        </div>

    <?php
    }else{
    ?>
    <div class="jumbotron" style="font-size: 18px;">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, aliquam cupiditate debitis eius eligendi exercitationem facilis ipsa iste magnam magni maxime nostrum, officia officiis quasi quo rem, repudiandae. Nihil, quia!
    </div>
    <?php
    }
    ?>

</div>
