class StackCreate{
	private int arr[];
	private int top;
	private int maxSize;

	StackCreate(int size){
		arr = new int[size];
		top = -1;
		this.maxSize = size;
	}

	public int getTop(){
		return top;
	}

	public void push(int data){
		if (!isEmpty()) {
			arr[++top] = data;
		}
		else{
			System.out.println("Stack is empty.");			
		}
	}

	public int pop(){
		if (!isEmpty()) {
			return arr[top--]; 
		}
		return -1;
	}

	public int peek(){
		if (!isEmpty()) {
			return arr[top];	
		}
		else {
			System.exit(-1);
		}
		return -1;
	}

	public int size(){
		return top+1;
	}

	public boolean isEmpty(){
		if (top + 1 == maxSize) {
			return true;
		}
		else{
			return false;
		}
	}
}
class Stack{
	public static void main(String[] args) {
		StackCreate ss = new StackCreate(4);

		System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		ss.push(2);
		System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		ss.push(5);
		System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		ss.push(20);
		System.out.println("Top Number is : " + ss.getTop()); //Show Top number

		// System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		System.out.println("Top is : " + ss.peek()); //Show 20
		System.out.println("Size: " + ss.size()); //Show size

		ss.pop(); //Remove 20

		// System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		System.out.println("Top is : " + ss.peek()); // Show 5
		System.out.println("Size: " + ss.size()); //Show size

		ss.pop(); // Remove 5

		// System.out.println("Top Number is : " + ss.getTop()); //Show Top number
		System.out.println("Top is : " + ss.peek()); // Show 2
		System.out.println("Size: " + ss.size()); //Show size
	}
}