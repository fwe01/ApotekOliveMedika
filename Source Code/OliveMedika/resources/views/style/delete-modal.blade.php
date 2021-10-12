<style>
    .delete-confirmation {
        display: none;
        z-index: 0;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        padding-top: 50px;
    }

    .delete-confirmation button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .delete-confirmation button:hover {
        opacity: 1;
    }

    .delete-confirmation .cancelbtn,
    .delete-confirmation .deletebtn {
        float: left;
        width: 50%;
    }

    .delete-confirmation .cancelbtn {
        background-color: #ccc;
        color: black;
    }

    .delete-confirmation .deletebtn {
        background-color: #f44336;
    }

    .delete-confirmation .container {
        padding: 16px;
        text-align: center;
    }

    .delete-confirmation .content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        border: 1px solid #888;
        width: 80%;
    }

    .delete-confirmation hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    .delete-confirmation .close {
        position: absolute;
        right: 35px;
        top: 15px;
        font-size: 40px;
        font-weight: bold;
        color: #f1f1f1;
    }

    .delete-confirmation .close:hover,
    .delete-confirmation .close:focus {
        color: #f44336;
        cursor: pointer;
    }

    .delete-confirmation .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
