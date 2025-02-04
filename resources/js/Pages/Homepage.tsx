import React from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import Wallet from '@/Components/Home/Wallet';
import Statistik from '@/Components/Home/Statistic';

type HomepageProps = {
    totalMakesta: string;
    totalLakmud: string;
    totalLakut: string;
    totalLatinpel: string;
    users: {
        id: string;
        name: string;
        cadre_level: string;
        pac: {
            pac: string;
        };
    }[];
};

const Homepage = ({ totalMakesta, totalLakmud, totalLakut, totalLatinpel, users }) => {
    console.log(users);
    return (
        <>
            <Head>
                <link rel="stylesheet" href="/mobile_assets/assets/css/style.css" />
            </Head>
            <div>
                <Navbar />
                <div id="appCapsule">
                    <Wallet />
                    <Statistik
                        totalMakesta={totalMakesta}
                        totalLakmud={totalLakmud}
                        totalLakut={totalLakut}
                        totalLatinpel={totalLatinpel}
                    />
                </div>

                <div className="section mb-4 mt-4">
                    <div className="section-heading">
                        <h2 className="title">Kader</h2>
                    </div>

                    {users.data.map((user) => (
                        <div className="transactions mb-4" key={user.id}>
                            <a href="app-transaction-detail.html" className="item">
                                <div className="detail">
                                    <img
                                        src={`storage/images/${user.img}`}
                                        alt={user.name}
                                        className="image-block imaged"
                                        style={{ width: '48px', height: '48px', objectFit: 'cover' }}
                                    />
                                    <div>
                                        <strong>{user.name}</strong>
                                        <p>{user.cadre_level}</p>
                                    </div>
                                </div>
                                <div className="right">
                                    <div className="price text-danger">{user.pac.pac}</div>
                                </div>
                            </a>
                        </div>
                    ))}
                </div>

                <div className="section mb-4 mt-4">
                    <h1>#salamPergerakan</h1>
                </div>
                <Footer />
            </div>
        </>
    );
};

export default Homepage;
