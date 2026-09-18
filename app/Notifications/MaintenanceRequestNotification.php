<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceRequestNotification extends Notification
{
    use Queueable;

    public $maintenanceRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($maintenanceRequest)
    {
        $this->maintenanceRequest = $maintenanceRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('طلب صيانة جديد: ' . ($this->maintenanceRequest->device_name ?? 'جهاز جديد'))
            ->greeting('مرحباً بك!')
            ->line('تم إرسال طلب صيانة جديد عبر المتجر.')
            ->line('اسم العميل: ' . ($this->maintenanceRequest->user_name ?? 'غير محدد'))
            ->line('نوع الجهاز: ' . ($this->maintenanceRequest->device_name ?? 'غير محدد'))
            ->line('تفاصيل المشكلة: ' . ($this->maintenanceRequest->issue_description ?? 'لا يوجد وصف'))
            ->action('عرض تفاصيل الطلب', url('/admin/maintenance-requests/' . $this->maintenanceRequest->id))
            ->line('يرجى مراجعة لوحة التحكم لمتابعة الطلب.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'request_id' => $this->maintenanceRequest->id,
            'user_name' => $this->maintenanceRequest->user_name ?? null,
            'device_name' => $this->maintenanceRequest->device_name ?? null,
            'message' => 'طلب صيانة جديد للجهاز ' . ($this->maintenanceRequest->device_name ?? ''),
        ];
    }
}