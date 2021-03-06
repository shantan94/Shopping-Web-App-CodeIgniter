<?php
class project5_model extends CI_Model{
	function getUsername($user,$password){
		$query=$this->db->query("select * from customer where username='$user' and password=md5('$password')");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return null;
		}
	}
	function getAuthorInfo($name){
		$query=$this->db->query("select * from Book b join WrittenBy wb on b.ISBN=wb.ISBN join Author a on wb.ssn=a.ssn join Stocks s on wb.ISBN=s.ISBN where a.name='$name'");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return null;
		}
	}
	function getBookInfo($name){
		$query=$this->db->query("select * from Book b join WrittenBy wb on b.ISBN=wb.ISBN join Author a on wb.ssn=a.ssn join Stocks s on wb.ISBN=s.ISBN where b.title='$name'");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return null;
		}
	}
	function getPrevBooks($name){
		$query=$this->db->query("select * from Book b join WrittenBy wb on b.ISBN=wb.ISBN join Author a on wb.ssn=a.ssn join Stocks s on wb.ISBN=s.ISBN where a.name='$name' or b.title='$name'");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return null;
		}
	}
	function getShoppingCart($name){
		$query=$this->db->query("select * from Book b join WrittenBy wb on b.ISBN=wb.ISBN join Author a on wb.ssn=a.ssn join Stocks s on wb.ISBN=s.ISBN where b.ISBN='$name'");
		if($query->num_rows()>0){
			return $query->result();
		}
		else{
			return null;
		}
	}
	function updateStocks($name,$ISBN){
		$this->db->query("update Stocks set number=number-'$name' WHERE ISBN='$ISBN'");
	}
	function insertToShoppingBasket($insert){
		$this->db->insert('ShoppingBasket',$insert);
	}
	function insertToContains($insert){
		$this->db->insert('Contains',$insert);
	}
	function insertToShippingOrder($insert){
		$this->db->insert('ShippingOrder',$insert);
	}
	function register($insert){
		$this->db->insert('Customer',$insert);
	}
}
?>