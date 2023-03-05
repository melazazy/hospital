<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Medicines</div>
                <div class="number">{{ $tmedic }}</div>
            </div>
            <i class='bx bxs-notepad cart'></i>
        </div>
        <a class="box" href="{{ route('limits') }}">
            <div class="right-side">
                <div class="box-topic">Limites</div>
                <div class="number">{{ $lmedic }}</div>
            </div>
            <i class='bx bxs-notepad cart'></i>
        </a>
        <a class="box" href="{{ route('prescriptions.index') }}">
            <div class="right-side">
                <div class="box-topic">prescriptions</div>
                <div class="number">{{ $pres }}</div>
            </div>
            <i class='bx bxs-notepad cart'></i>
        </a>
        <a class="box" href="{{ route('medicine.index') }}">
            <div class="right-side">
                <div class="box-topic">Manage </div>
                <div class="number">Medicines</div>
            </div>
            <i class='bx bxs-notepad cart'></i>
        </a>
    </div>
</div>
