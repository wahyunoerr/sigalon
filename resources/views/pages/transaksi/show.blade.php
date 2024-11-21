@extends('layouts.app')
@section('title', 'Detail Transaksi')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Table with outer spacing</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p class="card-text">Using the most basic table up, here’s how
                    <code>.table</code>-based tables look in Bootstrap. You can use any example
                    of below table for your table and it can be use with any type of bootstrap tables.
                </p>
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>RATE</th>
                                <th>SKILL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Michael Right</td>
                                <td>$15/hr</td>
                                <td class="text-bold-500">UI/UX</td>

                            </tr>
                            <tr>
                                <td class="text-bold-500">Morgan Vanblum</td>
                                <td>$13/hr</td>
                                <td class="text-bold-500">Graphic concepts</td>

                            </tr>
                            <tr>
                                <td class="text-bold-500">Tiffani Blogz</td>
                                <td>$15/hr</td>
                                <td class="text-bold-500">Animation</td>

                            </tr>
                            <tr>
                                <td class="text-bold-500">Ashley Boul</td>
                                <td>$15/hr</td>
                                <td class="text-bold-500">Animation</td>

                            </tr>
                            <tr>
                                <td class="text-bold-500">Mikkey Mice</td>
                                <td>$15/hr</td>
                                <td class="text-bold-500">Animation</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
