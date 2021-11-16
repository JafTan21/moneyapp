<div class="col-md-4">
    <div class="form-group">
        <p>Search:</p>
        <input wire:model.debounce.1000ms="search" type="text" class="form-control">
    </div>
</div>
<div class="col-md-4 ">
    <p>Month & year</p>
    <div class="btn-group" role="group" aria-label="Basic example">
        <select wire:model="month" class="form-control">
            <option selected value="all">All</option>
            <option value='1'>Janaury</option>
            <option value='2'>February</option>
            <option value='3'>March</option>
            <option value='4'>April</option>
            <option value='5'>May</option>
            <option value='6'>June</option>
            <option value='7'>July</option>
            <option value='8'>August</option>
            <option value='9'>September</option>
            <option value='10'>October</option>
            <option value='11'>November</option>
            <option value='12'>December</option>
        </select>

        <input wire:model="year" placeholder="Year" type="text" class="form-control">
        <input wire:model="day" placeholder="Day" type="text" class="form-control">
    </div>
</div>