import java.util.*;
import java.lang.*;

class Node
{
	public int iData; // data item (key)
	public double dData; // data item
	public Node leftChild; // this node's left child public
	Node rightChild; // this node's rightchild
	
	public void displayNode() // display ourself
	{
		System.out.print('{');
		System.out.print(iData);
		System.out.print(", ");
		System.out.print(dData);
		System.out.print("} ");
	}
} // end class Node

class Tree
{
	private Node root; // first node of tree
	
	public void insert(int id, double dd)
	{
		Node newNode = new Node(); // make new newNode
		newNode.iData = id; // insert data
		newNode.dData = dd;

		if(root==null) // no node in
		{
			root = newNode;
		}
		else // root occupied
		{
			Node current = root; // start atroot
			Node parent;
			while(true) // (exits internally)
			{
				parent = current;
				if(id<current.iData) // go left?
				{
					current = current.leftChild;
					if(current == null) // if end of the line,
					{ 					// insert onleft
						parent.leftChild = newNode;
						return;
					}
				} // end if go left
				else // or go right?
				{
					current = current.rightChild;
					if(current == null) // if end of the line
					{ 					// insert onright
						parent.rightChild = newNode;
						return;
					}
				} // end else go right
			} // end while
		} // end else not root
	} // end insert()

	private void preOrder(Node localRoot)
	// locaRoot is the reference to root node
	{
		if(localRoot != null)
		{
			localRoot.displayNode();
			preOrder(localRoot.leftChild);
			preOrder(localRoot.rightChild);
		}
	}

	private void inOrder(Node localRoot)
	{
		if(localRoot != null)
		{
			inOrder(localRoot.leftChild); localRoot.displayNode();
			inOrder(localRoot.rightChild);
		}
	}

	private void postOrder(Node localRoot)
	{
		if(localRoot != null)
		{
			postOrder(localRoot.leftChild);
			postOrder(localRoot.rightChild);
			localRoot.displayNode();
		}
	}

	public Node find(int key) // find node with given key
	{ // (assumes non-emptytree)
		Node current= root; // start at root
		while(current.iData !=key) // while nomatch,
		{
			if(key<current.iData) // goleft?
				{
					current = current.leftChild;
				}
			else // or go right?
				{
					current = current.rightChild;
				if(current == null) // if no child,
				{
					return null; // didn't findit
				}
				}
			}
		return current; // found it
	} // end find()

} // end class Tree

class LinkedListTest{

	public static void main(String[] args) {
		Tree tt = new Tree();
		Node nd = 
		tt.insert(1 , 23);

		tt.displayNode();
	}
}