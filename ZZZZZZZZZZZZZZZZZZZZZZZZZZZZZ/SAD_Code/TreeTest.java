class BTNode{
	public int value;
	public BTNode left;
	public BTNode right;

}

class Tree{
	public BTNode root;

	public Tree(){
		this.root = null;
	}

	public void insert(int value){
		BTNode temp, tempTopNode;

		temp = new BTNode();

		temp.value = value;
		temp.left = null;
		temp.right = null;

		if (this.root == null) {
			this.root = temp;
		} 
		else{
			tempTopNode = root;
			while(tempTopNode != null){
				if (value > tempTopNode.value) {
					if (tempTopNode.right == null) {
						tempTopNode.right = temp;
						break;
					}
					else{
						tempTopNode = tempTopNode.right;
					}
				}
				else if (value < tempTopNode.value) {
					if (tempTopNode.left == null) {
						tempTopNode.left = temp;
						break;
					}
					else{
						tempTopNode = tempTopNode.left;
					}
				}
				else{
					System.out.println("Value of (" + value + ") --> Duplicate values not allowed.");
					break;
				}
			}
		}
	}

	public void find(int searchValue, BTNode ptrl){		
		if(ptrl == null)
		{
			return ;
		}
		if (ptrl.value == searchValue) {
			System.out.println("\t Searched value found. " + ptrl.value);
		}
		else{
			System.out.println("\t Current node value ->. " + ptrl.value);
			find(searchValue, ptrl.left);
			find(searchValue, ptrl.right);
		}
	}

	public void preorder(BTNode ptrl){
		if(ptrl == null)
		{
			return ;
		}
		System.out.println("\t" + ptrl.value);
		preorder(ptrl.left);
		preorder(ptrl.right);
	}

	public void inorder(BTNode ptrl){
		if(ptrl == null){return ;}
		inorder(ptrl.left);
		System.out.println("\t" + ptrl.value);
		
		inorder(ptrl.right);
	}

	public void postorder(BTNode ptrl){
		if(ptrl == null){return ;}
		postorder(ptrl.left);
		postorder(ptrl.right);
		System.out.println("\t" + ptrl.value);		
	}

	public void traverse(){
		System.out.println("\n Preorder traverse");
		preorder(root);	
		System.out.println("\n Inorder traverse");
		inorder(root);	
		System.out.println("\n Postorder traverse");
		postorder(root);	
	}
}

class TreeTest{
	public static void main(String[] args) {
		Tree tt = new Tree();
		tt.insert(10);
		tt.insert(8);
		tt.insert(15);
		tt.insert(7);
		tt.insert(9);
		tt.insert(13);
		tt.insert(16);
		tt.insert(1);
		tt.insert(2);

		tt.traverse();

		System.out.println("\n Search values Started. ---->");
		tt.find(9, tt.root);
	}
}