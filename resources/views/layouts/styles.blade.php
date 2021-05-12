<style>
    body{
        overflow-x: none;
        position: relative;
    }
    .page-footer{
        position: relative;
        bottom: 0;
        margin-top: 24vh;
        {{--  width: 100%;  --}}
        {{--  height: 2.5rem;  --}}
        {{--  clear: both;  --}}
    }
    a.sidebar-active {
        background-color: rgb(240, 191, 4);
    }

    .user-sidebar a {
        font-size: 15px;
        text-decoration: none;
        font-family: 'Ubuntu', sans-serif;
        font-size: 16px;
    }

    .user-sidebar .bg-light {
        background-color: #fcfcfc !important;
    }

    a.nav-link {
        font-size: 16px;
        color: #000000;
    }

    .sidebar-shade {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: 2000;
    }

    .sidebar-shade .outside {
        position: absolute;
        top: 0;
        left: 0px;
        width: 100%;
        height: 100%;
        background-color: transparent;
    }

    .sidebar-shade .outside.animate {
        -webkit-animation-name: bg-color;
        -webkit-animation-duration: 300ms;
        -webkit-animation-fill-mode: forwards;
        animation-name: bg-color;
        animation-duration: 300ms;
        animation-fill-mode: forwards;
    }

    @keyframes bg-color {
        from {
            background-color: transparent;
        }
        to {
            background-color: rgba(20, 20, 20, .3);
        }
    }

    @-webkit-keyframes bg-color {
        from {
            background-color: transparent;
        }
        to {
            background-color: rgba(20, 20, 20, .3);
        }
    }

    .sidebar-shade .sidebar {
        position: absolute;
        top: 0;
        left: 0px;
        width: 70%;
        height: 100%;
        opacity: 0;
        background-color: white;
        overflow-y: scroll;
    }

    .sidebar-shade .sidebar.animate {
        -webkit-animation-name: showUp; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 100ms; /* Safari 4.0 - 8.0 */
        -webkit-animation-fill-mode: forwards;
        animation-name: showUp;
        animation-duration: 100ms;
        animation-fill-mode: forwards;
    }

    @-webkit-keyframes showUp {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes showUp {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .sidebar .sidebar-link {
        font-family: 'Ubuntu', sans-serif;
        font-size: 16px;
        text-decoration: none;
    }

    .sidebar .sidebar-link:hover {
        background-color: rgba(233, 233, 233, .3);
        font-weight: bold;
    }

    .custom-lg-sidebar {
        border-top: none;
    }

    .custom-lg-sidebar a {
        font-family: 'Nunito', sans-serif;
        font-weight: bold;
        color: rgb(40, 40, 40);
    }

    .custom-lg-sidebar a:hover {
        text-decoration: none;
        background-color: #f1f1f1;
    }

    .custom-lg-sidebar-head a {
        padding: 8px;
        font-family: 'Nunito', sans-serif;
        font-weight: bolder;
        border-top: none;
        text-decoration:none;
        /*background-color: #f1f1f1;*/
        color: #e0a800;
    }
    .custom-lg-sidebar-head a:hover{
        text-decoration: none;
        background-color: #f1f1f1;
    }

    /*.btn-site {*/
    /*    font-family: 'Nunito', sans-serif;*/
    /*    background-color: #e0a800;*/
    /*    color: #fff;*/
    /*}*/

    .btn-outline-site {
        font-family: 'Nunito', sans-serif;
        border-color: #e0a800;
        background-color: transparent;
        color: #d09700;
    }

    .btn-outline-site:hover {
        background-color: #e0a800;
        color: #fff;
    }

    /*.btn-site:hover {*/
    /*    background-color: #d09700;*/
    /*}*/

    .border-bottom-1 {
        border-radius: 0px;
        border: none;
        border-bottom: 0.5px solid #818182;
    }

    .text-default-head {
        color: #e0a800;
    }

    .form-label {
        position: relative;
        left: 0;
        top: 40px;
        color: #aaa;
        transition: transform 150ms ease-out, font-size 150ms ease, color 150ms;
    }

    .focused .form-label {
        transform: translateY(-125%);
        font-size: .75em;
        color: #e0a800;
    }

    .filled {
        border-bottom-color: #e0a800;
    }

    .text-site {
        color: #c69500;
    }

    .active-tab {
        border-bottom: 2px solid #e0a800;
    }

    .tab-link {
        font-family: 'Nunito', sans-serif;
        font-size: 18px;
    }

    .edit-photo-box {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .edit-photo-box .child-box.btn-box {
        background: transparent !important;
        border: none;
    }

    .edit-photo-box .child-box.btn-box > button {
        border-radius: 50%;
        margin: auto;
        outline: none;
    }

    .edit-photo-box .child-box {
        width: 70px;
        height: 60px;
        background: url('/images/camera.png');
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 25%;
        display: inline-block;
        vertical-align: bottom;
    }

    .edit-photo-box .child-box > form {
        width: 100%;
        height: 100%;
        opacity: 0;
        display: block;
    }

    .edit-photo-box .child-box > input[type="file"] {
        width: 100%;
        height: 100%;
        opacity: 0;
        display: block;
    }

    input[name="property_pic"] {
        width: 100%;
        height: 100%;
        opacity: 0;
        display: block;
    }

    .child-box-close {
        position: relative;
        bottom: 70px;
        left: 60px;
        border-radius: 50%;
        width: 15px;
        font-size: .5em;
    }

    .popup-div {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(20, 20, 20, .3);
        z-index: 16;
    }

    .popup-div > .outside {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        /*background-color: red;*/
    }

    .popup-div .card {
        position: relative;
        top: 20vh;
    }

    .bg-site {
        background-color: rgb(240, 191, 4);
    }

    .btn-site-transparent {
        color: #d39e00;
        background-color: transparent;
        border-color: transparent;
    }
    .btn-site {
        color: #fff;
        background-color: rgb(240, 191, 4);
        border-color: rgb(240, 191, 4);
    }

    .btn-site:hover {
        color: #f1f1f1;
        background-color: #e0a800;
        border-color: #d39e00;
    }

    .btn-site:focus, .btn-site.focus {
        -webkit-box-shadow: 0 0 0 0.2rem rgba(222, 170, 12, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(222, 170, 12, 0.5);
    }

    .btn-site.disabled, .btn-site:disabled {
        color: #f1f1f1;
        background-color: rgb(240, 191, 4);
        border-color: rgb(240, 191, 4);
    }

    .btn-site:not(:disabled):not(.disabled):active, .btn-site:not(:disabled):not(.disabled).active,
    .show > .btn-site.dropdown-toggle {
        color: #f1f1f1;
        background-color: #d39e00;
        border-color: #c69500;
    }

    .btn-site:not(:disabled):not(.disabled):active:focus, .btn-site:not(:disabled):not(.disabled).active:focus,
    .show > .btn-site.dropdown-toggle:focus {
        -webkit-box-shadow: 0 0 0 0.2rem rgba(222, 170, 12, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(222, 170, 12, 0.5);
    }

    /* width */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #efba00;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #af810e;
    }

    .btn-danger {
        color: #fff;
        background-color: #c41325;
        border-color: #c41325
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #e8172c;
        border-color: #bd2130
    }

    .btn-danger.focus, .btn-danger:focus {
        box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
    }

    .btn-danger.disabled, .btn-danger:disabled {
        color: #fff;
        background-color: #c41325;
        border-color: #c41325
    }

    .btn-danger:not(:disabled):not(.disabled).active, .btn-danger:not(:disabled):not(.disabled):active, .show > .btn-danger.dropdown-toggle {
        color: #fff;
        background-color: #bd2130;
        border-color: #b21f2d
    }

    .btn-danger:not(:disabled):not(.disabled).active:focus, .btn-danger:not(:disabled):not(.disabled):active:focus, .show > .btn-danger.dropdown-toggle:focus {
        box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .5)
    }

    .img-wrapper {
        position: relative;
        padding-top: 56.25% !important;
    }

    .custom-img {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: auto;
    }

    .text-site {
        color: #efba00 !important
    }

    a.text-site:focus, a.text-site:hover {
        color: #af810e !important
    }

</style>
