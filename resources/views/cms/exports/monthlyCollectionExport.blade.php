<table>
    <thead>
        <tr>
            <th>U-ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Father Name</th>
            <th>Mobile</th>
            <th>Institute</th>
            <th>Monthly Payment</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($students as $student)
            <tr>
                <td>{{ $student->unique_id }}</td>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->father_name }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->institute }}</td>
                <td>{{ $student->studentCourse->monthly_payment }}</td>
            </tr>
        @endforeach --}}
    </tbody>
    {{-- <tfoot>
        <tr>
            <td colspan="7" style="text-align:right;"><strong>Total Monthly Payment:</strong></td>
            <td><strong>{{ $totalMonthlyPayment }}</strong></td>
        </tr>
    </tfoot> --}}
</table>
