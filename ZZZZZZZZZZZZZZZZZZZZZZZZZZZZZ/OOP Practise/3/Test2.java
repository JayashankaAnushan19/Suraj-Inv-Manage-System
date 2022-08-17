import java.util.*;

/* Class Node */
class Node
{
	protected int data;
	protected Node link;

	/* Constructor */
	public Node()
	{
		link = null;
		data = 0;
	}

	/* Constructor */
	public Node(int d,Node n)
	{
		data = d;
		link = n;
	}

	/* Function to set link to next Node */
	public void setLink(Node n)
	{
		link = n;
	}

	/* Function to set data to current Node */
	public void setData(int d)
	{
		data = d;
	}

	/* Function to get link to next node */
	public Node getLink()
	{
		return link;
	}

	/* Function to get data from current Node */
	public int getData()
	{
		return data;
	}
}

/* Class linkedStack */
class linkedStack
{
	protected Node top ;
	protected int size ;

	/* Constructor */
	public linkedStack()
	{
		top = null;
		size = 0;
	}

	/* Function to check if stack is empty */
	public boolean isEmpty()
	{
		return top == null;
	}

	/* Function to get the size of the stack */
	public int getSize()
	{
		return size;
	}

	/* Function to push an element to the stack */
	public void push(int data)
	{
		Node nptr = new Node (data, null);
		if (top == null)
			top = nptr;
		else
		{
			nptr.setLink(top);
			top = nptr;
		}
		size++ ;
	}

	/* Function to pop an element from the stack */
	public int pop()
	{
		if (isEmpty() )
			throw new NoSuchElementException("Underflow Exception") ;
		Node ptr = top;
		top = ptr.getLink();
		size-- ;
		return ptr.getData();
	}

	void display()
	{
		do{
			if (isEmpty() )
				throw new NoSuchElementException("Underflow Exception") ;
			Node ptr = top;
			top = ptr.getLink();
			System.out.println(ptr.getData());
			size-- ;			
		}while(top != null);	
	}
}

/* Class LinkedStackImplement */
public class Test2
{
	public static void main(String[] args)
	{
		Scanner scan = new Scanner(System.in);

		/* Creating object of class linkedStack */		
		linkedStack ls = new linkedStack();

		/* Perform Stack Operations */
		System.out.println("Linked Stack Test\n");

		char ch;

		do
		{
			System.out.println("\nLinked Stack Operations");
			System.out.println("1 :  push");
			System.out.println("2 :  pop");
			System.out.println("3 :  check empty");
			System.out.println("4 :  size");
			System.out.println("5 :  show stack.");
			int choice = scan.nextInt();

			switch (choice)
			{
			case  1:
				System.out.println("Enter integer element to push");
				ls.push( scan.nextInt() );
				break;
			case  2:
				try
				{
					System.out.println("Popped Element = "+ ls.pop());
				}
				catch (Exception e)
				{
					System.out.println("Error : " + e.getMessage());
				}
				break;
			case  3:
				System.out.println("Empty status = "+ ls.isEmpty());
				break;
			case  4:
				System.out.println("Size = "+ ls.getSize());
				break;
			case  5:
				System.out.println("Stack = ");
				//ls.display();
				break;
			default :
				System.out.println("Wrong Entry. \n ");
				break;
			}

			/* display stack */
			//ls.display();

			System.out.println("\n Do you want to continue (Type Y or N) ?\n");

			ch = scan.next().charAt(0);

		} while (ch == 'Y'|| ch == 'y');
	}
}