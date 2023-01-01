window.addEventListener('load',()=>{
    jQuery('#birthdate').persianDatepicker({
		initialValue: false,
		format: 'YYYY/MM/DD',
		altField: '.birthdate-alt'
	});
    const provinceTag = document.querySelector('#province');
    const cityTag = document.querySelectorAll('#city option');
   // console.log(cityTag);
   var ProvIndex=0;
    provinceTag.addEventListener('change',()=>{
        ProvIndex = provinceTag.selectedIndex;
        cityTag.forEach((item)=>{
            if(item.getAttribute('data-state') !== ProvIndex.toString()){
                item.setAttribute('class','hidden');
            }else{
                item.removeAttribute('class');
            }
        })
    });
    const btn = document.getElementById('btn');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const container = document.querySelector('.container');
    const porseshname = document.getElementsByClassName('porseshname');
    const ShowResult = document.getElementById('ShowResult');
    console.log(porseshname);
    btn.addEventListener('click',()=>{
       // alert('df');
        let user = username.value;
        let pass = password.value;
        if(user == "" || pass == ""){
            alert('وارد کردن نام کاربری و کلمه عبور الزامی است!')
        }else{
            const href='./verify.php';
            $.post(href,{'item[user]':user , 'item[pass]':pass},function(data){
               // alert(data)
               if(data == '1'){
                    container.classList.add('hidden');
                    porseshname[0].classList.remove('hidden');
                    ShowResult.classList.add('hidden');
               }else if(data == '2'){
                    container.classList.add('hidden');
                    porseshname[0].classList.add('hidden');
                    ShowResult.classList.remove('hidden');
               }else{
                   alert('نام کاربری و کلمه عبور معتبر نمی باشد.')
               }
            })
        }
    });
    
    const submit = document.querySelector('#submit');
     
    submit.addEventListener('click',()=>{
       const birthdate = document.getElementById('bDate');
       var selectedProvince = ProvIndex;
       const selectedCity = document.querySelector('#city').selectedIndex;
       const phone = document.querySelector('#phone');
       const email = document.querySelector(".email");
       const level = document.getElementsByName("level");
       const desc = document.getElementById('description');
       const checkbox = document.querySelectorAll('.checkbox:checked');
       let selectedR = 0;
       let sports = [];
       //console.log(level);
       level.forEach((item) =>{
           if(item.checked){
               selectedR = item.value;
           }
       })
       //console.log(checkbox);
       if(birthdate.value == ''){
           alert('فیلد تاریخ تولد نمیتواند خالی باشد');
           return false;
       }
       if(phone.value == ''){
           alert('فیلدشماره تماس نمی تواند خالی باشد');
           return false;
       }
       if(checkbox.length < 1){
           alert('انتخاب حداقل یک و حداکثر 3 آیتم ضروروی است!');
           return false;
       }else if(checkbox.length > 3){
           alert('حداکثر مجاز به انتخاب 3 ورزش هستید!');
           return false;
       }
       checkbox.forEach((item)=>{
           sports.push(item.value);
       });
       //console.log(sports);
       const href ='./register.php';
       $.post(href,{'item[birthdate]':birthdate.value,'item[province]':selectedProvince,'item[city]':selectedCity,'item[phone]':phone.value,'item[email]':email.value,'item[level]':selectedR,'item[desc]':desc.value,'item[sports]':sports},function (data){
            //alert(data);
            if(data == '1'){
               alert('پرسشنامه با موفقیت ثبت شد!');
               window.location.reload();
           }else{
               alert('ٍثبت اطلاعات با مشکل مواجه شده است');
            }
          
       })
  
   });
   $("#ShowRes").click(function(){
    // alert('sd');
     $.get("./showresult.php/",function(data){
         //console.log(data);
         var obj = eval("("+data+")");
         //console.log(obj.users);

         var title = {
             text: 'پایش ورزش'   
          };
          var subtitle = {
             text: 'مرکز پژوهشی دانشگاه'
          };
          var xAxis = {
             categories: [obj.sports[0],obj.sports[1],obj.sports[2],obj.sports[3],obj.sports[4],obj.sports[5],obj.sports[6],obj.sports[7],obj.sports[8]]
          };
          var yAxis = {
             title: {
                text: 'تعداد انتخاب ها'
             },
             plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
             }]
          };   

          var legend = {
             layout: 'vertical',
             align: 'right',
             verticalAlign: 'middle',
             borderWidth: 0
          };
          var series =  [{
                name: 'تعداد علاقه مندان',
                type: 'column',
                data: [parseInt(obj.users[0]),parseInt(obj.users[1]),parseInt(obj.users[2]),parseInt(obj.users[3]),parseInt(obj.users[4]),parseInt(obj.users[5]),parseInt(obj.users[6]),parseInt(obj.users[7]),parseInt(obj.users[8])]
             }, 
          ];

          var json = {};
          json.title = title;
          json.subtitle = subtitle;
          json.xAxis = xAxis;
          json.yAxis = yAxis;
          json.legend = legend;
          json.series = series;

          $('#container').highcharts(json);
        
                             
     });
 });
})