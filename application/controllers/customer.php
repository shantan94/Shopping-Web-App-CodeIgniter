<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class customer extends CI_Controller {
	public function index(){
		$this->page1();
	}
	public function page1(){
		$this->load->view('page1');
	}
	public function check(){
		$this->load->model('project5_model');
		$user=$this->input->post('username');
		$pass=$this->input->post('password');
		$data['username']=$this->project5_model->getUsername($user,$pass);
		if(count($data['username'])==1){
			session_start();
			$_SESSION['username']=$user;
			header("location: http://localhost/project5/index.php/customer/page2");
		}
		else{
			$data['error']="Username or Password is invalid";
			$this->load->view('page1',$data);
		}
	}
	public function page2(){
		session_start();
		$this->load->view('page2');
	}
	public function search(){
		session_start();
		$this->load->model('project5_model');
		if(isset($_GET['author'])){
			$name=$this->input->get('search');
			$data['ISBN']=$this->project5_model->getAuthorInfo($name);
		}
		if(isset($_GET['booktitle'])){
			$name=$this->input->get('search');
			$data['ISBN']=$this->project5_model->getBookInfo($name);
		}
		if(isset($_GET['prevsearch'])&&isset($_GET['search'])&&isset($_SESSION['previous'])){
			foreach($_SESSION['previous'] as $value1=>$value){
				if($_SESSION['previous'][$value1]!=null){
				$data[$value1]=$this->project5_model->getPrevBooks($value)[0];
				$data['ISBN'][]=$data[$value1];
				}
			}
			//print_r($data['ISBN']);
		}
		$this->load->view('page2',$data);
	}
	public function page3(){
		session_start();
		$data=[];
		$this->load->model('project5_model');
		if(isset($_SESSION['val'])&&isset($_SESSION['val1'])){
			//print_r($_SESSION['val']);
			foreach($_SESSION['val'] as $value1=>$value){
				$data[$value1]=$this->project5_model->getShoppingCart($value)[0];
				$data['ISBN'][]=$data[$value1];
			}
		}
		if(isset($_POST['buy'])){
			foreach($_SESSION['val'] as $value1=>$value){
				$get=$_SESSION['val1'][$value1];
				if($get<=$data['ISBN'][$value1]->number){
					$user=$_SESSION['username'];
					$ISBN=$data['ISBN'][$value1]->ISBN;
					$code=$data['ISBN'][$value1]->warehouseCode;
					$shoppingbasket=array('basketID'=>null,'username'=>$user);
					$contains=array('ISBN'=>$ISBN,'basketID'=>null,'number'=>$get);
					$shippingorder=array('ISBN'=>$ISBN,'warehouseCode'=>$code,'username'=>$user,'number'=>$get);
					$this->project5_model->updateStocks($get,$ISBN);
					$this->project5_model->insertToShoppingBasket($shoppingbasket);
					$this->project5_model->insertToContains($contains);
					$this->project5_model->insertToShippingOrder($shippingorder);
					//print_r($get);
				}
			}
		}
		$this->load->view('page3',$data);
	}
	public function page4(){
		$this->load->view('page4');
	}
	public function register(){
		$data=[];
		$this->load->model('project5_model');
		if(isset($_POST['register'])){
			$user=$this->input->post('username');
			$pass=$this->input->post('password');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$addr=$this->input->post('address');
			$register=array('username'=>$user,'address'=>$addr,'email'=>$email,'phone'=>$phone,'password'=>md5($pass));
			$query=$this->project5_model->register($register);
			print_r($query);
			if($query==0){
				$data['error']="Registration Successful";
			}
			else{
				$data['error']="Registration Failed";
			}
		}
		$this->load->view('page4',$data);
	}
}
?>