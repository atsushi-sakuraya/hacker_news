/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


$(function () {
    var $inputImages = $('input#upload__btn--images');
    var $previewImages = $('.preview-images');

    // 投稿画像をプレビュー表示
    $inputImages.change(function (e) {
        var images = e.target.files;
        for (var i = 0; i < images.length; i++) {
            var image = images[i];
            var reader = new FileReader();
            reader.onload = (function (image) {
                return function (e) {
                    $previewImages.append(
                        '<li class="preview-image" '
                        + 'style="background-image: url(\'' + e.target.result + '\')">'
                        + '</li>'
                    )
                }
            })(image);
            reader.readAsDataURL(image);
        }
    });

    // プロフィール画像のプレビュー
    var $editPhoto = $('input.edit-photo');
    var $headerPhoto = $('#profile-header-photo');
    var $editIcon = $('input.edit-icon');
    var $headerIcon = $('#profile-header-icon');
    previewImageOnBackground($editPhoto, $headerPhoto);
    previewImageOnBackground($editIcon, $headerIcon);
});

$(document).click(function () {
    var $cancelBtn = $('input.cancelBtn');
    $cancelBtn.click(function () {
        $(this).parent().remove();
    });
});

function previewImageOnBackground($input, $bg)
{
    $input.change(function (e) {
        var image = e.target.files[0];
        var reader = new FileReader();
        reader.onload = (function (image) {
            return function (e) {
                $bg.css("background-image", "url(\'" + e.target.result + "\')");
            }
        })(image);
        reader.readAsDataURL(image);
    });
}
