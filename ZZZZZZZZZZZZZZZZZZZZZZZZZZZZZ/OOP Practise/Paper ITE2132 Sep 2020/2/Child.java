class Parent{
	private int x;
	private int y;

	double addition(){
		return (x+y);
	}
}

class Child extends Parent{
	String name;
	String address;

	Child(String n, String address){
		name = n;
		address = address;
	}

	// Child(String n){
	// 	this(n);
	// }
}