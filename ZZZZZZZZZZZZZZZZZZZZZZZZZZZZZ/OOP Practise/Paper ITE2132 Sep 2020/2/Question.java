class Student{
	final void calcAverage(double mark1, double mark2){
		double avg = (mark1 + mark2)/2.0;
		System.out.println("Avg Mark of Student: "+avg);
	}
}

class PartTimeStudent extends Student{
	String name;

	@Override
	final void calcAverage(double mark1, double mark2){
		double avg = (mark1 + mark2)/2.0;
		System.out.println("Avg Mark of Part Time Student: "+avg);
	}
}

class Question{
	public static void main(String[] args) {
		PartTimeStudent pt = new PartTimeStudent();
		pt.calcAverage(50,30);		
	}
}







