export type SiteSettings = {
    site_name?: string | null;
    meta_keywords?: string | null;
    meta_description?: string | null;
    logo?: string | null;
    favicon?: string | null;
    phone?: string | null;
    email?: string | null;
    address?: string | null;
    instagram?: string | null;
    whatsapp?: string | null;
    facebook?: string | null;
    tiktok?: string | null;
    documents_iframe_url?: string | null;
    hero_title?: string | null;
    hero_subtitle?: string | null;
    hero_image?: string | null;
    manager_name?: string | null;
    manager_position?: string | null;
    manager_bio?: string | null;
    manager_photo?: string | null;
    advantages?: Advantage[];
    footer_text?: string | null;
};

export type Advantage = {
    title: string;
    description?: string;
};

export type CmsPage = {
    id: number;
    title: string;
    slug: string;
    content?: string | null;
    image?: string | null;
    image_url?: string | null;
    meta_title?: string | null;
    meta_description?: string | null;
    is_published: boolean;
    sort_order: number;
};

export type CmsGroup = {
    id: number;
    title: string;
    slug: string;
    content?: string | null;
    image?: string | null;
    image_url?: string | null;
    sort_order: number;
    is_active: boolean;
};

export type GalleryItem = {
    id: number;
    title: string;
    image: string;
    image_url?: string | null;
    sort_order: number;
    is_active: boolean;
};

export type TeamMember = {
    id: number;
    name: string;
    position: string;
    image?: string | null;
    image_url?: string | null;
    sort_order: number;
    is_active: boolean;
};
