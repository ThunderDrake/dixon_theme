// jQuery(document).ready(function ($) {
//     var add_form = $('#questionary_form');

//     // Сброс значений полей
//     $('#questionary_form input').on('blur', function () {
//         $('#questionary_form input').removeClass('error');
//         $('.error-name,.error-email,.error-comments,.message-success').remove();
//         $('#submit-feedback').val('Отправить сообщение');
//     });

//     // Отправка значений полей
//     var options = {
//         url: feedback_object.url,
//         data: {
//             action: 'feedback_action',
//             nonce: feedback_object.nonce
//         },
//         type: 'POST',
//         dataType: 'json',
//         beforeSubmit: function (xhr) {
//             // При отправке формы меняем надпись на кнопке
//             $('#submit-feedback').val('Отправляем...');
//         },
//         success: function (request, xhr, status, error) {
            
//             if (request.success === true) {
//                 // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
//                 add_form.after('<div class="message-success">' + request.data + '</div>').slideDown();
//                 $('#submit-feedback').val('Отправить сообщение');
//             } else {
//                 // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
//                 $.each(request.data, function (key, val) {
//                     $('.art_' + key).addClass('error');
//                     $('.art_' + key).before('<span class="error-' + key + '">' + val + '</span>');
//                 });
//                 $('#submit-feedback').val('Что-то пошло не так...');

//             }
//             // При успешной отправке сбрасываем значения полей
//             $('#add_feedback')[0].reset();
//         },
//         error: function (request, status, error) {
//             $('#submit-feedback').val('Что-то пошло не так...');
//         }
//     };
//     // Отправка формы
//     add_form.ajaxForm(options);
// });
document.addEventListener('DOMContentLoaded', ()=>{
    const validation = new JustValidate('#questionary_form');
    
    const inputMask = new Inputmask('+7 (999) 999-99-99');
    const dateMask = new Inputmask('99.99.9999');
    inputMask.mask(document.querySelector('.questionary__input--phone'));
    dateMask.mask(document.querySelector('.questionary__input--birthday'));
    dateMask.mask(document.querySelector('.questionary__input--education-end'));
    validation
    .addField('.questionary__input--name', [
        {
        rule: 'minLength',
        value: 3,
        },
        {
        rule: 'maxLength',
        value: 30,
        },
        {
        rule: 'required',
        errorMessage: 'Имя обязательно для заполнения',
        },
    ])
    .addField('.questionary__input--phone', [
        {
        rule: 'required',
        errorMessage: 'Телефон обязателен для заполнения',
        },
        {
        rule: 'function',
        validator: function() {
            const phone = document.querySelector('.questionary__input--phone').inputmask.unmaskedvalue();
            return phone.length === 10;
        },
        errorMessage: 'Введите корректный номер телефона'
        },
    ])
    .addField('.questionary__input--birthday', [
        {
        rule: 'required',
        errorMessage: 'Введите дату рождения',
        },
        {
        rule: 'function',
        validator: function() {
            const phone = document.querySelector('.questionary__input--birthday').inputmask.unmaskedvalue();
            return phone.length === 8;
        },
        errorMessage: 'Введите дату рождения'
        },
    ])
    .addField('.questionary__input--citizenship', [
        {
        rule: 'minLength',
        value: 3,
        },
        {
        rule: 'maxLength',
        value: 30,
        },
        {
        rule: 'required',
        errorMessage: 'Гражданство обязательно для заполнения',
        },
    ]);
    validation.onSuccess((ev) => {
    let formData = new FormData(ev.target);
    formData.append('action', 'questionary_form_action');
    formData.append('nonce', questionary_form_object.nonce);
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            document.querySelector('#questionary_form .questionary__submit').textContent = 'Отправлено!'
            console.log('Отправлено');
        }
        }
    }

    xhr.open('POST', questionary_form_object.url, true);
    xhr.send(formData);

    ev.target.reset();
    })
})

//   for (let item of rules) {
//     validation
//       .addField(item.ruleSelector, item.rules);
//   }

//   validation.onSuccess((ev) => {
//     let formData = new FormData(ev.target);

//     let xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function () {
//       if (xhr.readyState === 4) {
//         if (xhr.status === 200) {
//           if (afterSend) {
//             afterSend();
//           }
//           console.log('Отправлено');
//         }
//       }
//     }

//     xhr.open('POST', 'mail.php', true);
//     xhr.send(formData);

//     ev.target.reset();
//   })