<div class="home-car-card">
    <div class="car-image-container">
        <img src="{{ $car->image }}" alt="{{ $car->title }}">
        <div class="car-price-tag">{{ number_format($car->price) }} ريال</div>
        @if($car->status === 'new')
            <div class="car-status status-new">جديد</div>
        @elseif($car->status === 'used')
            <div class="car-status status-used">مستعمل</div>
        @elseif($car->status === 'sold')
            <div class="car-status status-sold">تم البيع</div>
        @endif
    </div>

    <div class="car-content">
        <h3 class="car-title">{{ $car->title }}</h3>
        
        <div class="car-specs">
            <div class="spec-item">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ $car->year }}</span>
            </div>
            <div class="spec-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>{{ number_format($car->mileage) }} كم</span>
            </div>
            <div class="spec-item">
                <i class="fas fa-gas-pump"></i>
                <span>{{ $car->fuel_type }}</span>
            </div>
            <div class="spec-item">
                <i class="fas fa-cog"></i>
                <span>{{ $car->transmission }}</span>
            </div>
        </div>

        @if($car->features)
        <div class="car-features">
            @foreach(array_slice(explode(',', $car->features), 0, 3) as $feature)
                <span class="feature-tag">{{ trim($feature) }}</span>
            @endforeach
        </div>
        @endif
    </div>

    <div class="car-footer">
        <div class="car-location">
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ $car->location }}</span>
        </div>
        <div class="car-actions">
            <a href="{{ route('car.details', $car->id) }}" class="car-btn btn-details">
                <i class="fas fa-eye"></i>
                <span>التفاصيل</span>
            </a>
            <button type="button" class="car-btn btn-favorite" onclick="toggleFavorite({{ $car->id }})">
                <i class="fas fa-heart"></i>
            </button>
        </div>
    </div>
</div> 