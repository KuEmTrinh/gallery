<?php
include("header.php");
include 'db_conn.php';
?>

<style>
    .form {
        width: 80%;
        height: 100%;
        float: none;
        margin: 0 auto;
        padding: 0.5em 1em;
        color: #696969;
        background: white;
        border-top: solid 5px #696969;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.22);

    }

    .form-title_name {
        text-align: center;
        font-size: 50px;
        margin: 40px 0 0 0;
    }

    .form-content {
        margin: 20px 0 0 0;
    }

    .text {
        margin: 5px 0 10px 0;
        width: 100%;
    }

    .form-btn {
        font-size: 20px;
        border: 6px outset #c0c0c0;
        background-color: #dcdcdc;
        cursor: pointer;
    }

    .messages {
        position: fixed;
        right: 1rem;
        top: 1rem;
        z-index: 300;
    }

    .message {
        margin-top: 0.5rem;
        display: flex;
        flex-direction: column;
        padding: 1rem 2rem;
        font-weight: bold;
        font-size: 1.5rem;
        border-radius: 0.6rem;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        background-color: #ffffff;
    }

    .flex {
        display: flex;
    }

    .jc-right {
        justify-content: right;
    }
</style>


<div id="app">
    <div class="messages">
        <div class="message" v-for="mes in message">
            {{mes}}
        </div>
    </div>
    <div class="form">
        <div class="form-title">
            <h2 class="form-title_name">ご質問、お問い合わせはこちらへ</h2>
            <p class="form-title_text">
                testmailer0110@gmail.com宛にメールを送信します。（スパム対策のため@を●に変換しています。ご了承ください。）
                必要事項をお書きのうえ送信ボタンを押してください。<br>
                迷惑メール欄にメールが届いているかも知れませんのでご確認ください。メールが届きましたら、後日ご連絡いたします。

            </p>
        </div>
        <div class="form-content">
            お名前（必須）<br>
            <span class="must">
                <input type="text" class="text" required="required" v-model="name">
            </span>
            <br>

            メールアドレス（必須）<br>
            <span class="must">
                <input type="email" class="text"  required="required" v-model="email">
            </span>
            <br>

            件名<br>
            <span class="must">
                <input type="text" class="text" required="required" v-model="subject">
            </span>
            <br>

            メッセージ本文<br>
            <span class="must">
                <textarea rows="20" wrap="soft" class="text" required="required" v-model="content"></textarea>
            </span>
        </div>
        <div class="wrap flex jc-right">
            <button name="send" value="送信" @click.prevent="sendEmail(),memoryEmail()" class="form-btn">送信</button>
        </div>
    </div>
</div>


</html>

<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                name: "",
                email: "",
                subject: "",
                content: "",
                message: [],
            }
        },
        methods: {
            async clear() {
                this.message.pop();
                this.message.pop();
            },
            async sendEmail() {
                axios.post('controller/MailController.php', {
                    action: 'sendMail',
                    name: this.name,
                    email: this.email,
                    subject: this.subject,
                    content: this.content,
                }, this.message.push('送信中......')).then((response) => {
                    this.message.push(response.data)
                    setTimeout(() => {
                        this.clear();
                    }, 5000)
                })
            },

            async memoryEmail() {
                // alert('Memory');
                axios.post('controller/MailController.php', {
                    action: 'memoryMail',
                    name: this.name,
                    email: this.email,
                    subject: this.subject,
                    content: this.content,
                }).then((response) => {
                    // this.message = response.data;
                    // console.log(response.data);
                })
            }

        },
        created() {},
        mounted() {},
    })
</script>


<?php
include("footer.php");
?>