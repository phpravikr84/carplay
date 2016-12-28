<?php
class ControllerAccountMailsubscribe extends Controller {

	private $error = array();

	public function index() {
		$this->load->model('account/customer');
		
	}

	public function subscription() {
		$email = $this->request->post['subscribemail'];
		$this->load->model('account/customer');



			if(isset($email) && !empty($email) && $email!=''){
					//echo $email." have successfully subscribe!";

					$mail_exist = $this->model_account_customer->existMailSubscription($email);

						if($mail_exist == 1){
							

								
								echo $email." mail subscribed for newsletter! Please check your Inbox.";
						}
						if($mail_exist == 2){
							echo "Mail already subscribed!";
						}
						if($mail_exist == 0){

							$this->model_account_customer->mailSubscribeNew($email);
							
							echo $email." a new mail subscribed for newsletter! Please check your Inbox.";
						}

					

			}
			if(!isset($email) || empty($email) || $email==''){

				echo "Mail field is empty!";
			}
	}
}