// ---------------------------------------------------------
// SAMPLE vendor data for the Explore Vendors page (frontend only).
//
// - All businesses below are fictional, written for UI preview purposes.
// - `category` and `location` use the same slugs as the dropdowns in
//   resources/views/components/vendor-search-form.blade.php
// - `price` is a "starting package" price in LKR; `priceNote` explains what it covers.
// - `islandWide: true` means the vendor travels anywhere in Sri Lanka, so they
//   also match when a different location is selected.
// - The order of this array is the "Recommended" order.
//
// When the real backend exists, replace this file with a fetch() to your API and
// keep the same field names.
// ---------------------------------------------------------

export const vendors = [
    {
        id: 1, name: 'Lotus Pavilion Grand Ballroom', category: 'venues', location: 'colombo', islandWide: false,
        rating: 4.8, reviews: 212, price: 950000, priceNote: '150-guest ballroom package',
        description: 'A pillar-free ballroom in the heart of Colombo with crystal chandeliers, a bridal suite and in-house event coordination.',
        highlights: ['Up to 400 guests', 'Bridal suite included', 'Valet parking'],
    },
    {
        id: 2, name: 'Silver Frame Studios', category: 'photography', location: 'colombo', islandWide: true,
        rating: 4.9, reviews: 188, price: 185000, priceNote: 'Full-day coverage, 2 photographers',
        description: 'Editorial-style wedding photography and cinematic highlight films, covering homecomings, poruwa ceremonies and receptions.',
        highlights: ['Two photographers', 'Online gallery in 3 weeks', 'Printed album option'],
    },
    {
        id: 3, name: 'Spice Route Catering', category: 'catering', location: 'colombo', islandWide: false,
        rating: 4.8, reviews: 167, price: 320000, priceNote: 'Buffet for 100 guests',
        description: 'Sri Lankan and fusion wedding buffets with live hopper and kottu stations, prepared by a team of experienced chefs.',
        highlights: ['Live food stations', 'Vegetarian menus', 'Tasting session'],
    },
    {
        id: 4, name: 'Blush & Bloom Floral Design', category: 'decoration', location: 'colombo', islandWide: true,
        rating: 4.9, reviews: 154, price: 210000, priceNote: 'Stage and entrance styling',
        description: 'Fresh-flower stage designs, poruwa styling and table centrepieces in soft blush, ivory and gold palettes.',
        highlights: ['Poruwa styling', 'Fresh flowers', 'Same-day setup crew'],
    },
    {
        id: 5, name: 'Galle Fort Heritage Courtyard', category: 'venues', location: 'galle', islandWide: false,
        rating: 4.9, reviews: 96, price: 780000, priceNote: 'Courtyard + ceremony setup, 120 guests',
        description: 'A restored colonial courtyard inside the fort walls, ideal for intimate ceremonies under frangipani trees at sunset.',
        highlights: ['Up to 160 guests', 'Sunset ceremonies', 'Heritage setting'],
    },
    {
        id: 6, name: 'Glow Bridal Studio', category: 'beauty', location: 'colombo', islandWide: true,
        rating: 4.9, reviews: 201, price: 90000, priceNote: 'Bridal makeup, hair and saree draping',
        description: 'Bridal makeup artists and hairstylists who travel to your home or hotel, with a trial session before the big day.',
        highlights: ['Trial session', 'Saree draping', 'Travels to your venue'],
    },
    {
        id: 7, name: 'Poruwa Stories Photography', category: 'photography', location: 'kandy', islandWide: true,
        rating: 4.8, reviews: 122, price: 120000, priceNote: 'Ceremony and reception coverage',
        description: 'Warm, candid storytelling for Kandyan and low-country weddings, with a focus on family moments and rituals.',
        highlights: ['Candid style', 'Drone shots', 'Digital delivery'],
    },
    {
        id: 8, name: 'Kandyan Heirloom Jewellers', category: 'bridal', location: 'kandy', islandWide: false,
        rating: 4.7, reviews: 88, price: 260000, priceNote: 'Bridal jewellery set',
        description: 'Handcrafted Kandyan-style bridal sets and custom designs, made by a family workshop with three generations of experience.',
        highlights: ['Custom designs', 'Handcrafted', 'Rental sets available'],
    },
    {
        id: 9, name: 'Saree Couture by Ishara', category: 'bridal', location: 'colombo', islandWide: false,
        rating: 4.8, reviews: 136, price: 140000, priceNote: 'Bridal saree with fitting',
        description: 'Designer Kandyan osaris, silk sarees and groom outfits, tailored with two fittings and finishing to your timeline.',
        highlights: ['Two fittings', 'Groom wear', 'Rental and custom'],
    },
    {
        id: 10, name: 'Hill Country Tea Estate Gardens', category: 'venues', location: 'nuwara-eliya', islandWide: false,
        rating: 4.7, reviews: 64, price: 420000, priceNote: 'Garden ceremony for 80 guests',
        description: 'A misty hillside garden among tea bushes, with a colonial bungalow for the couple and cool-climate photo backdrops.',
        highlights: ['Up to 120 guests', 'On-site accommodation', 'Scenic backdrops'],
    },
    {
        id: 11, name: 'Kandyan Feast Caterers', category: 'catering', location: 'kandy', islandWide: false,
        rating: 4.7, reviews: 103, price: 240000, priceNote: 'Buffet for 100 guests',
        description: 'Traditional rice-and-curry spreads served in clay pots, plus welcome drinks, sweets and a dedicated service team.',
        highlights: ['Traditional menu', 'Clay-pot service', 'Sweets counter'],
    },
    {
        id: 12, name: 'The Sugar Lotus Cakery', category: 'cakes', location: 'colombo', islandWide: false,
        rating: 4.8, reviews: 119, price: 45000, priceNote: 'Three-tier wedding cake',
        description: 'Custom wedding cakes, cupcake towers and dessert tables, with eggless and vegan options on request.',
        highlights: ['Eggless options', 'Dessert tables', 'Free tasting box'],
    },
    {
        id: 13, name: 'Negombo Lagoon Beach Resort', category: 'venues', location: 'negombo', islandWide: false,
        rating: 4.6, reviews: 141, price: 560000, priceNote: 'Beachfront package, 100 guests',
        description: 'A beachfront resort with lagoon-view lawns, sunset ceremony decks and rooms for the wedding party.',
        highlights: ['Beachfront ceremony', 'Rooms for guests', 'Airport nearby'],
    },
    {
        id: 14, name: 'Raga Wedding Band', category: 'music', location: 'colombo', islandWide: true,
        rating: 4.7, reviews: 94, price: 130000, priceNote: 'Four-hour live performance',
        description: 'An eight-piece live band covering baila, Bollywood and classic English hits, with a professional sound crew.',
        highlights: ['8-piece band', 'Own sound system', 'Baila and pop sets'],
    },
    {
        id: 15, name: 'Coastal Light Films', category: 'photography', location: 'galle', islandWide: true,
        rating: 4.7, reviews: 77, price: 160000, priceNote: 'Wedding film, 5-minute highlight',
        description: 'Cinematic wedding films and same-day edits shot along the southern coast and beyond.',
        highlights: ['Same-day edit', 'Drone footage', '4K delivery'],
    },
    {
        id: 16, name: 'Jaffna Hearth Kitchen', category: 'catering', location: 'jaffna', islandWide: false,
        rating: 4.6, reviews: 49, price: 180000, priceNote: 'Buffet for 100 guests',
        description: 'Northern-style wedding feasts, from crab curry to traditional sweets, cooked fresh on site.',
        highlights: ['Northern cuisine', 'On-site cooking', 'Seafood menus'],
    },
    {
        id: 17, name: 'Poruwa Dreams Decor', category: 'decoration', location: 'kurunegala', islandWide: false,
        rating: 4.6, reviews: 72, price: 95000, priceNote: 'Poruwa and hall decoration',
        description: 'Traditional poruwa construction and hall decoration with banana stem, coconut flowers and brass lamps.',
        highlights: ['Traditional poruwa', 'Hall decoration', 'Brass oil lamps'],
    },
    {
        id: 18, name: 'Nilu\u2019s Bridal Artistry', category: 'beauty', location: 'galle', islandWide: false,
        rating: 4.6, reviews: 59, price: 55000, priceNote: 'Bridal makeup and hair',
        description: 'Natural-finish bridal makeup and hairstyling for southern-coast weddings, with early-morning availability.',
        highlights: ['Natural look', 'Early starts', 'Bridesmaid packages'],
    },
    {
        id: 19, name: 'Vintage Wheels Wedding Cars', category: 'transport', location: 'kandy', islandWide: true,
        rating: 4.6, reviews: 52, price: 75000, priceNote: 'Classic car with chauffeur, 6 hours',
        description: 'Restored classic cars decorated with fresh flowers, with uniformed chauffeurs for the bridal party.',
        highlights: ['Classic cars', 'Floral decoration', 'Chauffeur included'],
    },
    {
        id: 20, name: 'Inkwell & Lotus Stationery', category: 'invitations', location: 'colombo', islandWide: true,
        rating: 4.7, reviews: 66, price: 38000, priceNote: '100 printed invitations',
        description: 'Letterpress and foil-stamped invitations, save-the-dates and ceremony programmes in Sinhala, Tamil and English.',
        highlights: ['Trilingual designs', 'Foil stamping', 'Island-wide delivery'],
    },
    {
        id: 21, name: 'Ceylon Table Banquets', category: 'catering', location: 'negombo', islandWide: false,
        rating: 4.5, reviews: 58, price: 150000, priceNote: 'Buffet for 100 guests',
        description: 'Reliable banquet catering with seafood specials for beach and hotel weddings around Negombo.',
        highlights: ['Seafood specials', 'Hotel partnerships', 'Staff included'],
    },
    {
        id: 22, name: 'Baila Beats DJ Collective', category: 'music', location: 'negombo', islandWide: true,
        rating: 4.5, reviews: 67, price: 60000, priceNote: 'Five-hour DJ set with lighting',
        description: 'High-energy DJs and MCs with dance-floor lighting, perfect for homecoming parties and receptions.',
        highlights: ['MC included', 'Dance-floor lighting', 'Custom playlists'],
    },
    {
        id: 23, name: 'Pixel & Petal', category: 'photography', location: 'kurunegala', islandWide: false,
        rating: 4.5, reviews: 41, price: 85000, priceNote: 'Ceremony coverage, 1 photographer',
        description: 'Friendly, affordable photography for small and mid-size weddings, with quick turnaround on edited photos.',
        highlights: ['Quick turnaround', 'Budget friendly', 'Pre-shoot included'],
    },
    {
        id: 24, name: 'Sacred Grove Garden Venue', category: 'venues', location: 'anuradhapura', islandWide: false,
        rating: 4.4, reviews: 27, price: 300000, priceNote: 'Garden venue, 150 guests',
        description: 'A tree-shaded garden venue with a covered stage and plenty of parking, close to the sacred city.',
        highlights: ['Covered stage', 'Ample parking', 'Up to 250 guests'],
    },
    {
        id: 25, name: 'Sunset Mandap Studio', category: 'decoration', location: 'matara', islandWide: false,
        rating: 4.4, reviews: 33, price: 70000, priceNote: 'Mandap and entrance decor',
        description: 'Colourful mandap and entrance decoration for southern weddings, with lighting and drapery included.',
        highlights: ['Lighting included', 'Drapery', 'Quick setup'],
    },
    {
        id: 26, name: 'Trinco Bay Photography', category: 'photography', location: 'trincomalee', islandWide: false,
        rating: 4.6, reviews: 36, price: 110000, priceNote: 'Beach shoot and ceremony coverage',
        description: 'Golden-hour beach portraits and ceremony photography on the east coast, with an optional engagement shoot.',
        highlights: ['Beach portraits', 'Golden-hour shoots', 'Engagement shoot option'],
    },
];
