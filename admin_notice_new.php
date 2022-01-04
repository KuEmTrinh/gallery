<?php
include 'admin_header.php';
?>
<style>
    .new_notice {
        margin-top: 5rem;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        
    }
    .notice_form{
        display: flex;
        flex-direction: column;
    }
    .input{
        width: 20rem;
        padding: 0.7rem;
        text-align: center;
        border: 1px solid #373737;
        border-radius: 0.3rem;
        margin: 0.4rem; 
    }
    .text-left{
        text-align: left;
    }
    .imput-hight{
        height: 10rem;
    }
    .submit{
        background-color: #909090;
        border:none;
        color: white;
        font-weight: bold;
        border-radius: 0.3rem;
        padding: 0.5rem;
    }
</style>
<div class="new_notice">
    <form action="admin_notice_confirm.php" method="post" enctype="multipart/form-data" class="notice_form">
        <h1>・タイトル名</h1>
        <input type="title" name="title" class="input" required="required" placeholder="タイトル">
        <h1>・内容</h1>
        <textarea type="textarea" name="text" required="required" class="input imput-hight text-left"></textarea>
        <input type="submit" name="submit" class="submit">
    </form>
</div>