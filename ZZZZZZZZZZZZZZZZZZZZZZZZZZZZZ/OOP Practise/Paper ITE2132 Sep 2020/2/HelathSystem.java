import java.util.*;

abstract class Doctor{
	String name;
	String address;
	String phoneNumber;
	String regNo;
	double totalPay;

	Doctor(String name,	String address,	String phoneNumber,	String regNo){
		this.name = name;
		this.address = address;
		this.phoneNumber = phoneNumber;
		this.regNo = regNo;
	}

	Doctor(double totalPay){
		this.totalPay = totalPay;
	}

	double totalPayment(int num){
		return num;
	}
}

class GeneralPractitioner extends Doctor{
	double hourlyRate;
	GeneralPractitioner(String name,String address,	String phoneNumber,	String regNo, double hourlyRate){
		super(name, address, phoneNumber, regNo);
		this.hourlyRate = hourlyRate;
	}

	@Override
	double totalPayment(int visitingHours){
		return (hourlyRate * visitingHours);
	}
}

class Specialist extends Doctor{
	double chargePerHour;

	Specialist(String name,String address,	String phoneNumber,	String regNo, double chargePerHour){
		super(name, address, phoneNumber, regNo);
		this.chargePerHour = chargePerHour;
	}

	@Override
	double totalPayment(int numOfPateints){
		return (chargePerHour * numOfPateints);
	}
}

class HelathSystem{
	public static void main(String[] args) {	
		Scanner docName = new Scanner(System.in);
		System.out.println("Enter Doctor's Name :- ");
		String docNameTxt = docName.nextLine();

		Scanner docAddress = new Scanner(System.in);
		System.out.println("Enter Doctor's Address :- ");
		String docAddressTxt = docAddress.nextLine();

		Scanner docPhone = new Scanner(System.in);
		System.out.println("Enter Doctor's Phone :- ");
		String docPhoneTxt = docPhone.nextLine();

		Scanner docRegNo = new Scanner(System.in);
		System.out.println("Enter Doctor's RegNo :- ");
		String docRegNoTxt = docRegNo.nextLine();


		Scanner docType = new Scanner(System.in);
		System.out.println("Select Doctor type.");
		System.out.println("    1 - General Practitioner");
		System.out.println("    2 - Specialist");
		String docTypeSelect = docType.nextLine();

		if (docTypeSelect == "1") { //1 - General Practitioner
			Scanner genHourRate = new Scanner(System.in);
			System.out.println("Enter hourly Rate: ");
			int hourlyRate = Integer.parseInt(genHourRate.nextLine());

			Scanner genVisitHours = new Scanner(System.in);
			System.out.println("Enter visiting hours: ");
			int genVisitHoursEnter = Integer.parseInt(genVisitHours.nextLine());

			// totalPayment(genVisitHoursEnter);
			GeneralPractitioner gen = new GeneralPractitioner(docNameTxt, docAddressTxt, docPhoneTxt, docRegNoTxt, hourlyRate);

		}
		else if(docTypeSelect == "2") { //2 - Specialist
			Scanner obj = new Scanner(System.in);
			System.out.println("Select Doctor type.");
			String text = obj.nextLine();
		}
		else{
			System.out.println("Invalid inpput. Please eneter valid data.");
		}
	}
}