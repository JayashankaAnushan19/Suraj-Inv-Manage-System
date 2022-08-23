class Node{
	private int data;
	Node next;

	public Node(int data){
		this.data = data;
	}

	public int getDataValueOfNode(){
		return data;
	}
}


class MainC{
	public static void main(String[] args) {
		Node start = new Node(10);		
		start.next = new Node(20);
		start.next.next = new Node(30);
		start.next.next.next = new Node(40);
		for(Node p = start; p != null; p = p.next){
			System.out.println("Data value: " + p.getDataValueOfNode());
			System.out.println("Memory address of the node: " + p);
		}
	}
}