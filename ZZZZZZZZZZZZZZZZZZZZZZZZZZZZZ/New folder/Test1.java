class LinkedList{
	Node head;
	Node rare;

	public LinkedList(){
	}

	public void insertNode(int data){
		Node p = new Node(data);
		if (head == null) {
			head = rare = p;
			head.data = data;
			head.next = rare;
		}
		else {			
			rare.next = p;
			rare = p;
		}
	}

	public void getHead(){
		System.out.println("Head : " + head + "   || Data : " + head.data + "   || Next : " + head.next + "\n");
	}

	public void getRare(){
		System.out.println("Rare : " + rare + "   || Data : " + rare.data + "   || Next : " + rare.next + "\n");
	}
}

class Node{
	public int data;
	Node next;

	public Node(int data){
		this.data = data;
	}
}

class Test1{
	public static void main(String[] args) {
		LinkedList lst = new LinkedList();
		lst.insertNode(25);		
		lst.insertNode(35);
		lst.insertNode(45);
		lst.insertNode(55);
		lst.getHead();
		lst.getRare();
	}	
}