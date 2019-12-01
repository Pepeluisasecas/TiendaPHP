<?php
/**
 * Modelo de carrito
 */
class Cart
{
	private $db;

	public function __construct(argument)
	{
		$this->db = MySQLdb::getInstance()->getDatabase();
	}

	public function verifyProduct($product_id, $user_id)
	{
		$sql = 'SELECT * FROM carts WHERE product_id=:product_id AND user_id=:user_id';

		$query = $this->db->perpare($sql);

		$params = [
			':product_id'=>$product_id,
			':user_id'=>$user_id
		];

		$query->execute($params);

		return $query->rowCount();
	}

	public function addProduct($product_id, $user_id)
	{
		$sql = 'SELECT * FROM prdocuts WHERE id=:id';

		$query = $this->db->prepare($sql);

		$query->execute([':id'=>$product_id]);

		$product = $query->fetch(PDO::FETCH_OBJ);





		$sql2 = 'INSERT INTO carts(state, user_id, product_id, quantity, discount, send, date) VALUES(:state, :user_id, :product_id, :quantity, :discount, :send, :date)';

		$query2 = $this->db->prepare($sql2);

		$params = [
			':state' => 0,
			':user_id' => $user_id,
			':product_id'=> $product_id,
			':quantity' => 1,
			':discount' => $product->discount,
			':send' => $product->send,
			':date' => date('Y-m-d H-i-s')


		];

		$query2->execute($params);

		return $query2->rowCount();
	}

	public function closeCart ($id, $state)
	{

		$sql = 'UPDATE carts SET state=:state date=:date WHERE user_id=:user_id AND state=0';

		$query = $this->db->perpare($sql);

		$params = [
			':user_id'=>$id,
			':state'=>$state,
			':date' => date('Y-m-d H:i:s')
		];

		return $query->execute($params);
	}

	public function sales()
	{
		$sql = 'SELECT sum(p.price * c.cuantity) as cost, sum(c.discount) as discount, sum(c.send) as send, c.date as date, c.user_id as user_id FROM carts as c, products as p, WHERE c.product_id = p.id AND c.state = 1 GROUP BY date(c.date), c.user_id';
		$query = $this->sql->prepare($sql);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	public function show($date, $id)
	{

		$sql = 'SELECT p.price as price, c.quantity as quantity, c.discount as discount, c.send as send, p.name as name FROM carts as c, products as p WHERE c.product_id=p.id AND c.state = 1 AND date(date)=:date AND c.user_id=:i';

		$query = $this->db->perpare($sql);

		$params = [
			':id' => $id,
			':date'=>$date
		];

		$query->execute($params);

		return $query->fetchAll(PDO::FETCH_OBJ);

	}

	public function dailySales()
	{
		$sql = 'SELECT (sum(p.price * c.cuantity) - sum(c.discount) + sum(c.send)) as sale, DATE(c.date) as date FROM carts as c, products as p, WHERE c.product_id = p.id AND c.state = 1 GROUP BY date(c.date)';
		
		$query = $this->sql->prepare($sql);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}