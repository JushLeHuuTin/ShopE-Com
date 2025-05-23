let validator = (option) => {
    const formEle = document.querySelector(option.form)
    if (formEle) {
        let ruleSelect = {}
        let getParent = (inputEle) => {
            let resultEle = inputEle.parentElement;
            while (!resultEle.matches('.form-group')) {
                resultEle = resultEle.parentElement
            }
            return resultEle
        }
        let validate = (inputEle, rule) => {
            let msg;
            let preantEle = getParent(inputEle)
            for (let value of ruleSelect[rule.selector]) {
                if ((msg = value(inputEle.value))) {
                    break;
                }
            }
            if (msg) {
                preantEle.querySelector('span').innerText = msg
                preantEle.classList.add('error')
            } else {
                preantEle.querySelector('span').innerText = '';
                preantEle.classList.remove('error')
            }
            return msg;
        }
        option.rules.forEach((rule) => {
            if (Array.isArray(ruleSelect[rule.selector])) {
                ruleSelect[rule.selector].push(rule.test);
            } else {
                ruleSelect[rule.selector] = [rule.test]
            }
            let inputEle = formEle.querySelector(rule['selector'])
            //xu li khi blur khoi input
            inputEle.onblur = () => {
                validate(inputEle, rule)
            }
            inputEle.oninput = () => {
                let preantEle = getParent(inputEle)
                preantEle.querySelector('span').innerText = '';
                preantEle.classList.remove('error')
            }
        })
        let data = {};
        formEle.onsubmit = (event) => {
            event.preventDefault();
            let isValid = true;
            option.rules.forEach((rule) => {
                let inputEle = formEle.querySelector(rule.selector);
                let valid = validate(inputEle, rule);
                if (valid) {
                    isValid = false;
                } else {
                    // Nếu hợp lệ, lưu giá trị của input vào đối tượng `data`
                    if (inputEle.name == 'fullName' || inputEle.name == 'email' || inputEle.name == 'password') {

                        data[inputEle.name] = inputEle.value;
                    }
                }
            });
            // lưu tài khoản đăng ký localStorage
            if (Object.keys(data).length > 0) {
                localStorage.setItem("Account" + localStorage.length, JSON.stringify(data));
                if (confirm("Tạo tài khoản thành công bạn có muốn đăng nhập ?")) {
                    window.location.href = "login.html";
                }
            }

            //lưu tai khoản bằng php

        }
    }
}
//hàm random
let getRandom = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
//xu li captcha
let captchaNumber = document.querySelector('.captcha-number');
let resultNumber = getRandom(1000, 9999);
if (captchaNumber) {
    captchaNumber.innerText = "Xác thực captcha: " + resultNumber;
}
let captchar = document.querySelector('#captcha');
if (captchar) {
    captchar.setAttribute('pattern', resultNumber);
}
let login = () => {
    // console.log(localStorage.getItem('HuuTin'))
    let formEle = document.querySelector('#form-1');
    formEle.onsubmit = () => {
        if (!formEle.checkValidity() == true) {
            event.preventDefault();
        } else {
            //kiểm tra thông tin tài khoản đăng nhập

            // for(let i = 0; i < localStorage.length; i++){
            //     let key = localStorage.key(i);
            //     let data = JSON.parse(localStorage.getItem(key))
            //     if(document.querySelector('#email').value == data.email ){
            //         if(confirm('thanh cong đến trang chủ chứ')){
            //             //lưu tai khoản đăng nhập thành công
            //             localStorage.setItem('loggedInUser',JSON.stringify(data))
            //             window.location.href=`index.html?`
            //         }
            //     }
            // }

        }
        formEle.classList.add('was-validated');
    }
}
validator.isRequired = (selector) => {
    return {
        selector: selector,
        test: function (value) {
            return value.trim().length != 0 ? undefined : '* Vui long khong de trong'
        }
    }
}
validator.isEmail = (selector) => {
    let regex = /^\w+(.\w+)*@\w+(.\w{3,})+(.\w{2,4})+$/
    return {
        selector: selector,
        test: (value) => {
            return regex.test(value) ? undefined : '* Truong nay la email'
        }
    }
}
validator.isPassword = (selector) => {
    let regex = /^(?=.*\W).{5,}$/
    return {
        selector: selector,
        test: (value) => {
            return regex.test(value) ? undefined : '* Nhap it nhat 1 ki tu dac biet'
        }
    }
}
validator.isPasswordReplay = (selector, pass) => {
    return {
        selector: selector,
        test: (value) => {
            return value == pass() ? undefined : '* Mat khau khong khop'
        }
    }
}


//show pass
let showpass = () => {
    let eyes = document.querySelectorAll(".fa-solid.fa-eye");
    if (eyes) {
        eyes.forEach((item) => {
            item.onclick = () => {
                if (item.parentElement.querySelector('.form-control').type == 'password') {
                    item.classList.add('active');
                    item.parentElement.querySelector('.form-control').setAttribute('type', 'text');

                } else {
                    item.classList.remove('active');
                    item.parentElement.querySelector('.form-control').setAttribute('type', 'password');
                }
            }
        })

    }
}
showpass();

function musicSelesct() {
    let isPlaying = true;
    let music = document.querySelector('#playMusic');
    let audio = new Audio('https://a128-z3.zmdcdn.me/a43409b8ded090746e9051022d6ca898?authen=exp=1741618993~acl=/a43409b8ded090746e9051022d6ca898*~hmac=f8f284bdc66238f5740277453d8e48e2');
    if (music.classList.contains('run')) {
        isPlaying = false;
        music.classList.remove('run');
    }
    if (isPlaying) {
        audio.play();
        isPlaying = false;
        music.classList.add('run');
        audio.onemptied = () => {
            audio.play();
        }
    } else {
        isPlaying = true;
        audio.pause();
        audio = null;
        audio.currentTime = 0;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab__item');
    const panels = document.querySelectorAll('.tab__panel');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove active from all tabs
            tabs.forEach(t => t.classList.remove('tab__active'));
            // Hide all panels
            panels.forEach(p => p.classList.add('d-none'));

            // Add active to clicked tab
            tab.classList.add('tab__active');
            // Show corresponding panel
            panels[index].classList.remove('d-none');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const sizeItems = document.querySelectorAll('.product__size--item');
    sizeItems.forEach(item => {
        item.addEventListener('click', function () {
            // Xóa active ở tất cả
            sizeItems.forEach(el => el.classList.remove('active'));
            // Thêm active cho item được chọn
            // Bấm vào label nhưng đảm bảo radio được checked luôn
            const input = item.querySelector('input[type="radio"]');
            input.checked = true;
            item.classList.add('active');
        });
    });
});
function toggleMenu(id) {
    const menu = document.getElementById(id);
    menu.classList.toggle('hidden');
}

function handleColorChange() {
    const select = document.getElementById('colorSelect');
    const customInput = document.getElementById('customColorInput');

    if (select.value === 'custom') {
        customInput.classList.remove('d-none');
    } else {
        customInput.classList.add('d-none');
        customInput.value = ''; // reset nếu người chọn lại option khác
    }
}

// hiển thị ảnh nhỏ theo thẻ input file khi chọn ảnh
if (document.getElementById('img_product')) {

    document.getElementById('img_product').onchange = (e) => {
        let file = (e.target.files[0]);
        document.querySelector('.display_img').src = URL.createObjectURL(file);
    }
}
// hiển thị modal hiển thị ảnh to khi click ảnh nhỏ
const productImages = document.querySelectorAll('.display_img');

productImages.forEach((item) => {
    const modalImage = document.querySelector('#modalImage');
    const imageModal = new bootstrap.Modal(document.querySelector('#imageModal'));
    item.onclick = function () {
        modalImage.src = this.src;
        imageModal.show();
    }

})


// productImage.onclick = function () {
//     modalImage.src = this.src;
//     imageModal.show();
// }
