<?php
include("header.php");
include 'db_conn.php';

$sql = "SELECT id"
?>
<style>
</style>
<div id="app" class="contract">
  <div class="contract">
  <div class="contract-name">
  <h1>契約内容</h1>
  </div>
    <div class="contract-items">
      <div class="contract-iten" v-for="(item,index) in contract" :key="item.id">
        <div class="contract__title">
          <h1>・名前: {{item.name}}</h1>
         </div>


        

        <div class="contract__content">
          <h1>{{item.content}}</h1>
        </div>

      </div>
    </div>

  </div>


</div>
<div class="attention">
  <div class="attention-name">
    <h1>注意事項</h1>
  </div>
</div>

<script>
    var vm = new Vue({
        el:'#app',
        data:function(){
            return{
                contract:[],
                name:"",
                content:"",
                id:"",
            }
        },
        methods: {
            async getContract(){
                axios.post('controller/ContractController.php',{
                    action: 'getContract',
                }).then((responsr) => {
                    this.contract = response.data;
                    console.log(response.data);
                })
            }
        },


 
    }
    )
</script>
<?php
include 'footer.php';
?>