class Node{
	public int data;
	public Node link;

	Node(int d){
		this.data = d;
		this.link = null;
	}	

	Node(int d, Node link){
		this.data = d;
		this.link = link;
	}

	void setLink(Node link){
		this.link = link;
	}
 
	void setData(int d){
		this.data = d;
	}

	Node getLink(){
		return link;
	}

	int getData(){
		return data;
	}

}

class LinkedList{
	public int size;
	public Node top;

	LinkedList(){
		top = null;
	}

	public Node pop(){
		return top.getLink();
	}

	void push(int d){
		Node newNode = new Node(d);
		top.setLink(d);
		
	}

	boolean isEmpty(){
		if (top==null) {
			return true;
		}
		else{
			return false;
		}
	}
}

class Test3{
	public static void main(String[] args) {
		
	}
}