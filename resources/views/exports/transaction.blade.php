<table>

    {{-- SUMMARY --}}
    <tr>
        <td colspan="2" bgcolor="#e6e6e6" style="font-weight: bold; font-size: 16px; padding: 6px;">
            Report Summary
        </td>
    </tr>

    <tr>
        <td width="200" style="font-weight: bold;">Total Income</td>
        <td data-format="#,##0.00">{{ $stats['total_income'] ?? $stats['total_expense']}}</td>
    </tr>

    <tr>
        <td style="font-weight: bold;">Transaction Count</td>
        <td>{{ $stats['transaction_count'] }}</td>
    </tr>

    <tr valign="top">
        <td style="font-weight: bold;">Top Categories</td>
        <td>
            @foreach ($stats['top_categories'] as $cat)
                {{ $cat['name'] }}: {{ number_format($cat['total'], 2) }}<br>
            @endforeach
        </td>
    </tr>

    {{-- BLANK ROW FOR SEPARATION --}}
    <tr>
        <td colspan="{{ count($columns) }}"></td>
    </tr>

    {{-- DATA SECTION LABEL (this is new) --}}
    <tr>
        <td colspan="{{ count($columns) }}" style="font-weight:bold;">Data</td>
    </tr>

    {{-- TABLE HEADERS --}}
    <tr>
        @foreach ($columns as $heading)
            <th>{{ $heading }}</th>
        @endforeach
    </tr>

    {{-- TABLE ROWS --}}
    @foreach ($rows as $row)
        <tr>
            @foreach ($columns as $key => $heading)
                <td>{{ data_get($row, $key) }}</td>
            @endforeach
        </tr>
    @endforeach

</table>
