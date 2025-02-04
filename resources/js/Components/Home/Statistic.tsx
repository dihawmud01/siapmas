type HomepageProps = {
    totalMakesta: string;
    totalLakmud: string;
    totalLakut: string;
    totalLatinpel: string;
};

const Statistik = (props: HomepageProps) => {
    return (
        <div className="section">
            <div className="row mt-2">
                <div className="col-6">
                    <div className="stat-box">
                        <div className="title">Makesta</div>
                        <div className="value text-success text-center">{props.totalMakesta}</div>
                    </div>
                </div>
                <div className="col-6">
                    <div className="stat-box">
                        <div className="title">Lakmud</div>
                        <div className="value text-success text-center">{props.totalLakmud}</div>
                    </div>
                </div>
            </div>

            <div className="row mt-2">
                <div className="col-6">
                    <div className="stat-box">
                        <div className="title">Lakut</div>
                        <div className="value text-success text-center">{props.totalLakut}</div>
                    </div>
                </div>
                <div className="col-6">
                    <div className="stat-box">
                        <div className="title">Latinpel</div>
                        <div className="value text-success text-center">{props.totalLatinpel}</div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Statistik;
