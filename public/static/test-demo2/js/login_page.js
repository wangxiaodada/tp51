var app = new Vue({
	el:'.container',
	data:{
		title: "用户登录",
		user: "",
		password: "",
		placeholder1: "请输入身份证号",
		placeholder2: "请输入密码",
		tips:"",
		tips2:"",
		btn_text: "提交"
	},
	methods:{
		login:function(){
			let url = "/userLogin";
			this.$http.post(url, {
					cardid: this.user,
					password: this.password
			},{emulateJSON: true}).then(function(result){
				console.log(result.body)
				if(result.body.code == 1){
                    window.location.href = "/userOne";
				}else{
					this.tips2 = result.body.error
				}
			},function(){
				alert("服务器错误！");
			})
		}
	},
	watch:{
		user:function(newVal, oldVal){
			if(this.user.length == 18 || this.user.length == 0){
				this.tips = "";
			}
			else{
				this.tips = "请输入正确的身份证号";
			}
		}
	}
})