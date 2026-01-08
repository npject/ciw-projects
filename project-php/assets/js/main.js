function valid(){
    const username = document.querySelector("#username");
    const pass = document.querySelector("#password");
    const passRepeat = document.querySelector("#pass-repeat");
    const email = document.querySelector("#email");
    const phoneNumber = document.querySelector("#phone-number");
    let isValidate = true;
    [username,pass,passRepeat,email,phoneNumber].forEach(item=>{
        if(!item.value.trim()){
            item.classList.add('is-invalid');
            isValidate = false;
            return;
        }else{
            item.classList.remove('is-invalid');
        }
    })
    const regexPass = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/
    let validPass = regexPass.test(pass.value);
    if(!validPass){
        pass.classList.add('is-invalid');
        document.querySelector("#feedback-pass").classList.add("invalid-feedback");
        document.querySelector("#feedback-pass").innerText = `
        رمزعبور باید بین 8 تا 16 کاراکتر و شامل حروف کوچک و بزرگ و حداقل یک کاراکتر ویژه باشد!
        `;
        isValidate = false;
    }
    let match = pass.value.trim() == passRepeat.value.trim();
    if(validPass && !match){
        passRepeat.classList.add('is-invalid');
        document.querySelector("#feedback-pass-repeat").classList.add("invalid-feedback");
        document.querySelector("#feedback-pass-repeat").innerText =`
        رمز عبور به درستی تکرار نشده است!
        `;
        isValidate = false;
    }
    return isValidate;
}
function matchPass(){
    const pass = document.querySelector("#password").value.trim();
    const passRepeat = document.querySelector("#pass-repeat").value.trim();
    if(pass && pass == passRepeat){
        document.querySelector("#pass-repeat").classList.add('is-valid');
    }else{
        document.querySelector("#pass-repeat").classList.remove('is-valid');
    }
}
function validd(tag){
    let val = tag.classList.value;
    let x = val.includes('is-invalid');
    if(x){
        valid();
    }
}
function validLogin(){
    const username = document.querySelector("#username-login");
    const pass = document.querySelector("#password-login");
    let isValidate = true;
    [username,pass].forEach(item=>{
        if(!item.value.trim()){
            item.classList.add('is-invalid');
            isValidate = false;
            return;
        }else{
            item.classList.remove('is-invalid');
        }
    })
    return isValidate;
}
function convertData(){
    let items = document.querySelectorAll(".reg-date");
    if(items){
       items.forEach(item=>{
        item.innerText = moment(item.innerText, 'YYYY/MM/DD').locale('fa').format('YYYY/MM/DD');
       }) 
    }
};
document.addEventListener("DOMContentLoaded",function(){
    if(window.location.pathname.endsWith("profile.php")){
        convertData();
    }
});
async function removeUser(idUser){
    const toast = document.querySelector('#toast');
    const toastContent = document.querySelector('#toast .toast-body');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
    let fetchData = await fetch("api/delete-user.php",{
        method:"POST",
        body:JSON.stringify({
            id:idUser
        }) 
    });
    let res = await fetchData.json();
    if(res.status == 200){
        document.querySelector(`#user-${idUser}`).parentElement.parentElement.parentElement.remove();
        toastContent.innerText = `
        کاربر  ${idUser} حذف شد.
        `;
        toast.classList.add('text-bg-danger');
        toastBootstrap.show();
    }
}
function modalDelete(id){
    const btn = document.querySelector('#exampleModal #btn-ok');
    // document.querySelector('.modal-body').innerHTML =`       //نیازی نیست
    // <input type="hidden" value="${id}">
    // `;
    document.querySelector("#exampleModal #exampleModalLabel").innerText = `حذف کاربر..`;
    document.querySelector("#exampleModal .modal-body p").innerText =`
    آیا اطمینان دارید برای حذف کاربر ${id} ؟؟
    `;
    // btn.addEventListener('click',removeUser(id,ev));
    //btn.setAttribute('onclick',`removeUser(${id},${ev})`);     //دسترسی نداریم به ev
    btn.setAttribute('onclick',`removeUser(${id})`);    
}
function modalLogout(){
    const btn = document.querySelector('#exampleModal #btn-ok');
    document.querySelector("#exampleModal #exampleModalLabel").innerText = `خروج..`;
    document.querySelector("#exampleModal .modal-body p").innerText =`
    آیا میخواهید از حساب خود خارج شوید ؟؟
    `;
    btn.setAttribute('onclick','logout()');
}
function logout(){
    window.location.href = 'logout.php';
}
document.addEventListener("DOMContentLoaded",function(){
    if(window.location.pathname.endsWith("register.php")){
        const toast = document.querySelector('#toast');
        const toastContent = document.querySelector('#toast .toast-body');
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
        let params = new URLSearchParams(document.location.search);
        let msg = params.get('msg');
        if(msg == 'register is completed'){
            toastContent.innerText = `
            ثبت نام با موفقیت انجام شد.
            `;
            toast.classList.add('text-bg-success');
            toastBootstrap.show();
            setTimeout(()=>{window.location.href ='login.php'},4000);    
        }
    }
});
function prevImg(){
    const file = document.querySelector('#profile-image').files;
    document.querySelector('#img-prev').src = URL.createObjectURL(file[0]);
}
async function updateUser(idUser){
    const toast = document.querySelector('#toast');
    const toastContent = document.querySelector('#toast .toast-body');
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
    const username = document.querySelector("#username");
    const email = document.querySelector("#email");
    const phoneNumber = document.querySelector("#phone-number");
    let isValidate = true;
    [username,email,phoneNumber].forEach(item=>{
        if(!item.value.trim()){
            item.classList.add('is-invalid');
            isValidate = false;
            return;
        }else{
            item.classList.remove('is-invalid');
        }
    })
    if(isValidate == true){
        let dataFile = new FormData();
        dataFile.append('id',idUser);
        dataFile.append('username',document.querySelector('#username').value.trim());
        dataFile.append('email',document.querySelector('#email').value.trim());
        dataFile.append('phoneNumber',document.querySelector('#phone-number').value.trim());
        dataFile.append('profile_image',
            document.querySelector('#profile-image').files[0] ? 
            document.querySelector('#profile-image').files[0] : '');
        let fetchData = await fetch("api/api-edit-user.php",{
            method: "POST",
            body:dataFile
        });
        let resData = await fetchData.json();
        if(resData.status == 200){
            window.location.href = "profile.php";
        }
        if(resData.status == 500){
            toastContent.innerText = resData.data;
            toast.classList.add('text-bg-danger');
            toastBootstrap.show();
        }
    }
}