<!DOCTYPE html>
<html>
<head>
	<title>Loan Repayment Schedule</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
			margin: 0;
			padding: 10px;


		}
		h1 {
			font-size: 24px;
			margin-bottom: 20px;
		}
		p {
			margin-bottom: 10px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-bottom: 20px;
		}
		table th, table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: center;
			font-size: 12px;
		}
		table th {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<h1>Loan Repayment Schedule</h1>
    <p><strong>Loan Amount:</strong> {{ $loanAmount }}</p>
    <p><strong>Loan Term in Months:</strong> {{ $loanTermInMonths }}</p>
    <p><strong>Interest Rate:</strong> {{ $interestRate }}%</p>
    <p><strong>Monthly Payment without Interest:</strong> {{ $principal }}</p>
    <p><strong>Total Payment:</strong> {{ number_format($loanAmount + array_sum(array_column($loanSchedule, 'interest')), 2) }}</p>
	<table>
		<thead>
			<tr>
				<th>Due Date</th>
				<th>Description</th>
				<th>Principal</th>
				<th>Interest</th>
				<th>Due</th>
				<th>Principal Balance</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($loanSchedule as $schedule)
			<tr>
				<td>{{ $schedule['due_date'] }}</td>
				<td>{{ $schedule['description'] }}</td>
				<td>{{ $schedule['principal'] }}</td>
				<td>{{ $schedule['interest'] }}</td>
				<td>{{ $schedule['due'] }}</td>
				<td>{{ $schedule['principal_balance'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>
