<?php
include('admin_header.php');
include 'db_conn.php';

$sql = "SELECT id , name, content FROM tb_contract";
$result = $conn->query($sql);
?>

<input type="button" onclick="location.href='./admin_contract_create.php'" value="契約内容追加">
<br>
<input type="button" onclick="location.href='./admin_atten.php'" value="注意事項追加">

<hr>
<style>
    .flex {
        display: flex;
    }

    .attention {
        flex-wrap: wrap;
    }

    .attention-item {
        margin: 1rem;
        width: calc(20% - 2rem);
    }

    .attention-item__content {
        position: relative;
        -ms-flex-negative: 0;
        /* flex-shrink: 0; */
        width: 100%;
        padding-top: 100%;
        margin-bottom: 2rem;
        border-radius: 2rem;
        overflow: hidden;
        -webkit-box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
        box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
    }

    .attention-item__image img {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .attention-item h1 {
        text-align: center;
        font-weight: bold;
        margin-top: 1rem;
        font-size: 1.6rem;
    }

    .jc-sb {
        justify-content: space-between;
    }

    .atten__btn {
        padding: 0.5rem 1rem;
        background-color: #303030;
        color: white;
        border-radius: 0.5rem;
        width: 2rem;
    }

    .atten-edit {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .atten-edit input {
        padding: 1rem 2rem;
        border: none;
    }

    .edit__btn {
        margin: 0 auto;
    }

    .title {
        margin-top: 2rem;
        font-weight: bold;
        font-size: 2.1rem;
    }
</style>
<div id="app">
    <h1 class="title">
        注意事項リスト
    </h1>
    <div class="Attention flex jc-sb">
        <div class="Attention-item" v-for="attention in attentions" :key="attention.id">
            <div class="attention-item__content">
            </div>
            <h1>{{attention.name}}</h1>
        </div>
    </div>

    <div class="atten-list" v-for="(atten,index) in attentions" :key="atten.id">
        {{atten.content}} - {{atten.time}}
        <div class="flex">
            <div class="atten__btn" @click="deteleAttention(atten.id)">
                削除
            </div>
            <div class="atten__btn" @click="editAttention(index)">
                編集
            </div>
        </div>
    </div>

    <div class="atten-edit" v-if="toggle_atten == true">
        <input type="text" class="content" v-model="attention.content">
        <div class="atten__btn edit__btn" @click="editConfirm">
            確認
        </div>
    </div>




    <h1 class="title">
        契約のリスト
    </h1>
</div>


<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                attentions: '',
                attention: "",
                toggle_atten: false,
            }
        },
        methods: {
            async toggleAtten() {
                this.toggle_atten = !this.toggle_atten;
            },
            async getAttention() {
                axios.post('controller/AttentionController.php', {
                    action: 'getAttentions',
                }).then((response) => {
                    this.attentions = response.data;
                })
            },
            async deteleAttention(id) {
                axios.post('controller/AttentionController.php', {
                    action: 'deleteAttention',
                    id: id,
                }).then((response) => {
                    // console.log(response.data);
                    this.getAttention();
                })
            },
            async editAttention(index) {
                this.attention = this.attentions[index];
                this.toggleAtten();
            },
            async editConfirm() {
                axios.post('controller/AttentionController.php', {
                    action: 'attentionEdit',
                    id: this.attention.id,
                    content: this.attention.content,
                }).then((response) => {
                    console.log(response.data)
                    this.toggleAtten();
                    // this.getAttention();
                })
            }
        },
        created() {
            this.getAttention();
        },
        mounted() {},
    })
</script>