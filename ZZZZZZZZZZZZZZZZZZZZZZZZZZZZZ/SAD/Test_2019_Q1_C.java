class Test_2019_Q1_C{

private static void swap(int[] a, int i, int j) {
        int tmp = a[i];
        a[i] = a[j];
        a[j] = tmp;
    }
//--------------------------------------------------------------
public static void main(String[] args){
int A[]={2,3,-4,0,5,0,-1,7,-4};

		int a = 0;
        int b = A.length - 1;
		int i=0;
        while ((i < A.length) && (i <= b)) {
            int cur = A[i];
            if (cur < 0) {
					swap(A, i, a);
					a++;
            } else if (cur > 0) {
                swap(A, i, b);
                b--;
                i--;
            }
		  i++;	
        }//end while


//displaying array element
for(int t=0; t<A.length; t++)
	System.out.print(A[t]+"\t");

}
}