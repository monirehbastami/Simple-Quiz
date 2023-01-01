<?php 
include('./variables.php');
//print_r($cities);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/dp.css">
    </head>
    <body>
        <header>
            <h1>پرسشنامه طرح تحقیقاتی</h1>
        </header>
        <main>
            <div class="container">
                <form>
                    <img src="./img/login.png" alt="ورود" width="100px" height="100px" />
                    <input type="text" id="username"  placeholder="username:ssn" maxlength="10"/>
                    <input type="text" id="password"  placeholder="password:student code" maxlength="10"/>
                    <input type="button" value="ورود" id="btn" />
                </form>
            </div>
            <div class="porseshname hidden" >
                <div class="item">
                    <label for="birthdate" class="star">تاریخ تولد</label>
                    <input type="text"  name="birthdate" id="birthdate">
                    <input type="hidden" class="birthdate-alt" id="bDate">
                </div>
                <div class="item">
                    <label for="province">استان</label>
                    <select name="province" id="province">
                        <option value="'0">-</option>
                        <?php
                        foreach($provinces as $key => $value){
                            echo "<option value='$key'>$value</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="item">
                    <label for="city">شهر</label>
                    <select name="city" id="city">
                        <option value="0">-</option>
                        <?php
                        foreach($cities as $city ){
                            echo "<option data-state='$city[cit_provinceid]' value='$city[cit_id]'>$city[cit_name]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="item" >
                    <label for="phone" class="star">شماره تماس</label>
                    <input type="text" name="phone" id="phone" maxlength="10" placeholder="912XXXXXXX" >
                </div>
                <div class="item">
                    <label for="email">ایمیل</label>
                    <input type="email" name="email" class="email">
                </div>
                <div class="item">
                    <label for="level">تا چه حد از رشته تحصیلی خود رضایت دارید؟</label>
                    خیلی زیاد <input type="radio" name="level" value="1" >
                    زیاد<input type="radio" name="level" value="2" >
                    متوسط <input type="radio" name="level" value="3">
                خیلی کم <input type="radio" name="level" value="4" >
                </div>
                <div class="item">
                    <label for="soprts"  class="star">به کدامیک از ورزش های زیر علاقه مندید؟</label>
                    <?php
                    foreach($sports as $key => $value){
                        echo "$value <input type='checkbox' name='spr$key' class='checkbox' value='$key' /> ";
                    }
                    ?>
                </div>
                <div class="item">
                    <label for="birthdate">هرچه میخواهد دل تنگت بگو</label>
                    <textarea id="description"></textarea>
                </div>
                <div class="item">
                    <input type="button" id="submit" value="ثبت پرسشنامه">
                </div>  

            </div>
            <div id="ShowResult" class="hidden">
                <input type="button" id="ShowRes" value="مشاهده نتایج" />
                <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
            </div>
        </main>
        <footer>
            &#169;Monireh Bastami
        </footer>
        <script src = "./js/jquery.min.js"> </script>
        <script src = "./js/highcharts.js"></script>
        <script src="./js/script.js"></script>
        <script src="./js/dp.js"></script>
    </body>
</html>