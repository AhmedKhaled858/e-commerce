<?php
namespace App\Enums;

enum OrderStatus: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';

    // ترتيب الخطوات (لو الأوردر اتلغى بنعتبر ترتيبه 0 عشان ميعلمش أخضر على حاجة)
    public function stepLevel(): int
    {
        return match($this) {
            self::PENDING    => 1,
            self::PROCESSING => 2,
            self::SHIPPED    => 3,
            self::DELIVERED  => 4,
            self::CANCELLED  => 0, 
        };
    }

    public function getStyles(OrderStatus $currentStatus): array
    {
        $currentLevel = $currentStatus->stepLevel();
        $thisLevel = $this->stepLevel();

        // معالجة حالة الإلغاء بشكل منفصل
        if ($currentStatus === self::CANCELLED) {
            return [
                'border' => $this === self::CANCELLED ? 'border-rose-600' : 'border-gray-200',
                'bg'     => $this === self::CANCELLED ? 'bg-rose-100' : 'bg-transparent',
                'text'   => $this === self::CANCELLED ? 'text-rose-700' : 'text-gray-400',
                'opacity' => $this === self::CANCELLED ? 'opacity-100' : 'opacity-50',
            ];
        }

        // الحالة الحالية (Red)
        if ($thisLevel === $currentLevel) {
            return [
                'border' => 'border-rose-400',
                'bg'     => 'bg-rose-50/50',
                'text'   => 'text-rose-600',
                'opacity' => 'opacity-100'
            ];
        }

        // الحالات السابقة (Green)
        if ($thisLevel < $currentLevel && $thisLevel !== 0) {
            return [
                'border' => 'border-emerald-400',
                'bg'     => 'bg-emerald-50/50',
                'text'   => 'text-emerald-600',
                'opacity' => 'opacity-100'
            ];
        }

        // الحالات القادمة (Grey)
        return [
            'border' => 'border-gray-200',
            'bg'     => 'bg-transparent',
            'text'   => 'text-gray-400',
            'opacity' => 'opacity-50'
        ];
    }
}

?>
