class Queue{
	int size;
	int[] a;
	int front;
	int rare;

	Queue(int size){
		this.size = size;
		this.a = new int[size];
		front = rare = -1;
	}

	void enqueue(int x){
		if (!(isFull())) {
			if (rare == -1) {
				rare++;				
			}
			front++;
			a[front] = x;
		}
		else{
			System.out.println("Queue is full. Can not add more data.");
		}
	}

	boolean isEmpty(){
		if (front == -1){
			return true;
		}
		else {
			return false;
		}
	}

	boolean isFull(){
		if (front == size-1){
			return true;
		}
		else {
			return false;
		}
	}

	void dequeue(){
		if (isEmpty() != true) {
			dequeueFront();
		}
	}


	int dequeueFront(){
		return a[front];
	}

	void display(){
		if (!(isEmpty())) {
			for (int g = 0;g<size ;g++ ) {
				System.out.println("Element "+ g+" is :" + a[g] );
			}
		}
		else{
			System.out.println("Queue is empty");
		}
	}
}
class Test{
	public static void main(String[] args) {
		Queue q = new Queue(3);
		q.enqueue(1);
		q.enqueue(4);
		q.enqueue(6);
		q.dequeue();
		q.enqueue(8);
		q.display();
	}
}